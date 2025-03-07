<?php

namespace App\Http\Controllers;

use App\Models\Keyboard;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Keycap;
use App\Models\KeyboardSwitch;
use Illuminate\Support\Facades\Storage;
class AdminKeyboardController extends Controller
{
    /**
     * Display a listing of the keyboards.
     */
    public function index()
    {
        $keyboards = Keyboard::all(); // Or fetch keyboards through Product relationship
        return view('admin.keyboards.index', compact('keyboards'));
    }

    /**
     * Show the form for creating a new keyboard.
     */
    public function create()
    {
        $category = 'keyboard'; // Set category specifically for Keyboard creation
        $keycap = new Keycap();
        $keyboard = new Keyboard();
        $switch = new KeyboardSwitch();
        return view('admin.keyboards.create', compact('keycap', 'keyboard', 'switch', 'category')); // Specific create view for keyboards
    }

    /**
     * Store a newly created keyboard and its related product in storage.
     */
    public function store(Request $request)
    {
        // Validate data for Product and Keyboard
        $request->validate([
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string',
            'product.price' => 'required|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyboard.layout' => 'nullable|string|max:255',
            'keyboard.case_material' => 'nullable|string|max:255',
            'keyboard.pcb_type' => 'nullable|string|max:255',
            'keyboard.manufacturer' => 'nullable|string|max:255',
        ]);

        // Create Product, forcing category to 'keyboard'
        $product = Product::create(array_merge($request->input('product'), ['category' => 'keyboard']));

        // Handle image upload
        if ($request->hasFile('product.image')) {
            $product->image = $request->file('product.image')->store('products', 'public');
            $product->save();
        }

        // Create Keyboard detail and associate with Product
        $detail = new Keyboard($request->input('keyboard'));
        $detail->product()->associate($product);
        $detail->save();

        return redirect()->route('admin.keyboards.index')->with('success', 'Keyboard and Product created successfully.');
    }

    /**
     * Show the form for editing the specified keyboard.
     */
    public function edit($id)
    {
        $keyboard = Keyboard::with('product')->findOrFail($id);
        $product = $keyboard->product;
        
        return view('admin.keyboards.edit', compact('keyboard', 'product'));
    }

    /**
     * Update the specified keyboard in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate data for Product and Keyboard
        $request->validate([
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string',
            'product.price' => 'required|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyboard.layout' => 'nullable|string|max:255',
            'keyboard.case_material' => 'nullable|string|max:255',
            'keyboard.pcb_type' => 'nullable|string|max:255',
            'keyboard.manufacturer' => 'nullable|string|max:255',
        ]);

        $keyboard = Keyboard::findOrFail($id);
        $product = $keyboard->product;

        // Update Product
        $product->update($request->input('product'));

        // Handle image upload
        if ($request->hasFile('product.image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('product.image')->store('products', 'public');
            $product->save();
        }

        // Update Keyboard details
        $keyboard->update($request->input('keyboard'));

        return redirect()->route('admin.keyboards.index')
            ->with('success', 'Keyboard and Product updated successfully.');
    }

    /**
     * Display the specified keyboard.
     */
    public function show(Keyboard $keyboard)
    {
        // Eager load the product relationship to avoid N+1 problem
        $keyboard->load('product');
        
        return view('admin.keyboards.show', compact('keyboard'));
    }

    // Note: show, edit, update, destroy methods are NOT defined here - reusing ProductController methods.
};