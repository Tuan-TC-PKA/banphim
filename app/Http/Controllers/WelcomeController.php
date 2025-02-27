<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get one random product from each category
        $randomKeyboard = Product::where('category', 'keyboard')
            ->inRandomOrder()
            ->first();
            
        $randomKeycap = Product::where('category', 'keycap')
            ->inRandomOrder()
            ->first();
            
        $randomSwitch = Product::where('category', 'switch')
            ->inRandomOrder()
            ->first();
            
        return view('welcome', compact('randomKeyboard', 'randomKeycap', 'randomSwitch'));
    }
}