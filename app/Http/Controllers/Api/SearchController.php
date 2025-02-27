<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        return Product::where('name', 'like', "%{$query}%")
            ->select(['id', 'name', 'price', 'image'])
            ->take(5)
            ->get();
    }
}