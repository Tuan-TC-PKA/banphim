<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->category) {
            $query->where('category', $request->category);
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

        $products = $query->paginate(9);
        $products->appends($request->query());

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
