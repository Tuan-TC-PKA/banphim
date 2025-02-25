<?php

namespace App\Http\Controllers;

use App\Models\KeyboardSwitch;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Keycap;
use App\Models\Keyboard;
class AdminSwitchController extends Controller
{
    /**
     * Display a listing of the keyboard switches.
     */
    public function index()
    {
        $keyboardSwitches = KeyboardSwitch::all(); // Or fetch switches through Product relationship
        return view('admin.keyboard_switches.index', compact('keyboardSwitches'));
    }

    /**
     * Show the form for creating a new keyboard switch.
     */
    public function create()
    {
        $category = 'switch'; // Set category specifically for Switch creation
        $keycap = new Keycap();
        $keyboard = new Keyboard();
        $switch = new KeyboardSwitch();
        return view('admin.keyboard_switches.create', compact('keycap', 'keyboard', 'switch', 'category')); // Specific create view for switches
    }

    /**
     * Store a newly created keyboard switch and its related product in storage.
     */
    public function store(Request $request)
    {
        // Validate data for Product and Switch
        $request->validate([
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string',
            'product.price' => 'required|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'switch.type' => 'nullable|string|max:255',
            'switch.manufacturer' => 'nullable|string|max:255',
            'switch.actuation_force' => 'nullable|integer',
            'switch.bottom_out_force' => 'nullable|integer',
        ]);

        // Create Product, forcing category to 'switch'
        $product = Product::create(array_merge($request->input('product'), ['category' => 'switch']));

        // Handle image upload
        if ($request->hasFile('product.image')) {
            $product->image = $request->file('product.image')->store('products', 'public');
            $product->save();
        }

        // Create Switch detail and associate with Product
        $detail = new KeyboardSwitch($request->input('switch'));
        $detail->product()->associate($product);
        $detail->save();

        return redirect()->route('admin.keyboard_switches.index')->with('success', 'Switch and Product created successfully.');
    }

    // Note: show, edit, update, destroy methods are NOT defined here - reusing ProductController methods.

    /**
     * Display the specified keyboard switch.
     */
    public function show(KeyboardSwitch $keyboard_switch)
    {
        // Eager load the product relationship to avoid N+1 problem
        $keyboard_switch->load('product');
        
        return view('admin.keyboard_switches.show', [
            'switch' => $keyboard_switch
        ]);
    }
};