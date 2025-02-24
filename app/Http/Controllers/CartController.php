<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Get cart items for current user
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal;

        return view('user.cart', compact('cartItems', 'subtotal', 'total'));
    }

    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng');
        }

        $product = Product::findOrFail($id);
        
        // Check if product already exists in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            // Update quantity if product exists
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Create new cart item if product doesn't exist
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()
            ->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->firstOrFail();

        $quantity = max(1, min(intval($request->quantity), $cartItem->product->stock_quantity));
        
        $cartItem->quantity = $quantity;
        $cartItem->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Số lượng đã được cập nhật');
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->back()
            ->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để thanh toán');
        }

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'total_amount' => $total,
            'status' => 'pending',
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        // Create order items
        foreach($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Clear cart after successful checkout
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đặt hàng thành công');
    }
}