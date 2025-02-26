<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        Order::create($request->all());

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order')); 
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);
        // Sửa từ 'orders.edit' thành 'admin.orders.edit' 
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        // Thêm success vào session flash
        session()->flash('success', 'Cập nhật trạng thái đơn hàng thành công');

        // Chỉ redirect, không kèm with()
        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}