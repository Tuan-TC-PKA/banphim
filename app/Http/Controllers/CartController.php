<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = 0;
        
        // Lấy thông tin sản phẩm và tính tổng tiền
        foreach($cartItems as &$item) {
            $product = Product::find($item['product_id']);
            $item['product'] = $product;
            $subtotal += $product->price * $item['quantity'];
        }

        $total = $subtotal; // Remove shippingFee

        return view('user.cart', compact('cartItems', 'subtotal', 'total'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $id,
                'quantity' => 1
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để thanh toán');
        }

        $cartItems = session()->get('cart', []);
        if(empty($cartItems)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        $total = 0;
        $orderItems = [];

        foreach($cartItems as $item) {
            $product = Product::find($item['product_id']);
            $total += $product->price * $item['quantity']; // No shipping fee added
            $orderItems[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price
            ];
        }

        // Create order without shipping fee
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'total_amount' => $total,
            'status' => 'pending',
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        // Tạo chi tiết đơn hàng
        foreach($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đặt hàng thành công');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $quantity = max(1, intval($request->quantity));
            $product = Product::find($cart[$id]['product_id']);
            
            // Check stock availability
            if($product && $quantity <= $product->stock_quantity) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                
                if($request->ajax()) {
                    return response()->json(['success' => true]);
                }
                return redirect()->back()->with('success', 'Số lượng đã được cập nhật');
            }
        }

        if($request->ajax()) {
            return response()->json(['error' => 'Không thể cập nhật số lượng'], 400);
        }
        return redirect()->back()->with('error', 'Không thể cập nhật số lượng');
    }
}