<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by product name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Handle category filter
        if ($request->has('category')) {
            $categories = (array)$request->category;
            if (!in_array('all', $categories)) {
                $query->whereIn('category', $categories);
            }
        }

        // Apply sorting
        switch ($request->get('sort', 'newest')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
        }

        // Your existing filtering logic...
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // IN STOCK FILTER - This is the important part!
        if ($request->has('in_stock')) {
            $query->where('stock_quantity', '>', 0);
        }
        // ...other filters...

        $products = $query->paginate(12)->appends(request()->query());

        return view('shop', compact('products'));
    }

    public function category($category, Request $request)
    {
        $query = Product::where('category', $category);

        // Apply sorting
        switch ($request->get('sort', 'newest')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(9)->withQueryString();

        return view('shop', [
            'products' => $products,
            'currentCategory' => $category
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(9);

        return view('shop', [
            'products' => $products,
            'searchQuery' => $query
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.info', compact('product'));
    }
}
