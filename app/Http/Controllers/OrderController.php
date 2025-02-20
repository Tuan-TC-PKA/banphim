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
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        return view('orders.create');
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

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        // PHÂN QUYỀN BẰNG MIDDLEWARE - KHÔNG CÓ AUTHORIZE() TRONG CONTROLLER
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}