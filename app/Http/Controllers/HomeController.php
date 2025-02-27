<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

public function index()
{
    // Get one random product from each category
    $randomKeyboard = \App\Models\Product::where('category', 'keyboard')
        ->inRandomOrder()
        ->first();
        
    $randomKeycap = \App\Models\Product::where('category', 'keycap')
        ->inRandomOrder()
        ->first();
        
    $randomSwitch = \App\Models\Product::where('category', 'switch')
        ->inRandomOrder()
        ->first();
        
    return view('user.dashboard', compact('randomKeyboard', 'randomKeycap', 'randomSwitch'));
}
}
