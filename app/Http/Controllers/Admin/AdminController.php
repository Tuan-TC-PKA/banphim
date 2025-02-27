<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Get statistics data
        $totalProducts = Product::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Get best selling products
        $bestSellingProducts = OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByRaw('SUM(quantity) DESC')
            ->limit(5)
            ->with('product')
            ->get();
            
        return view('admin.dashboard', compact(
            'totalProducts', 
            'totalRevenue', 
            'totalOrders', 
            'pendingOrders',
            'bestSellingProducts'
        ));
    }
}
