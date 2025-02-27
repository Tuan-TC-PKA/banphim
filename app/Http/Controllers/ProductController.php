<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Keycap;
use App\Models\Keyboard;
use App\Models\KeyboardSwitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product (common edit form).
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $keycap = $product->keycapDetail;
        $keyboard = $product->keyboardDetail;
        $switch = $product->switchDetail;

        return view('admin.products.edit', compact('product', 'keycap', 'keyboard', 'switch'));
    }

    /**
     * Update the specified product and its related details in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validate data for Product and detail types
        $request->validate([
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string',
            'product.price' => 'required|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.category' => 'required|string|max:255',
            'product.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'keycap.material' => 'nullable|string|max:255',
            'keycap.profile' => 'nullable|string|max:255',
            'keycap.layout' => 'nullable|string|max:255',
            'keycap.manufacturer' => 'nullable|string|max:255',

            'keyboard.layout' => 'nullable|string|max:255',
            'keyboard.case_material' => 'nullable|string|max:255',
            'keyboard.pcb_type' => 'nullable|string|max:255',
            'keyboard.manufacturer' => 'nullable|string|max:255',

            'switch.type' => 'nullable|string|max:255',
            'switch.manufacturer' => 'nullable|string|max:255',
            'switch.actuation_force' => 'nullable|integer',
            'switch.bottom_out_force' => 'nullable|integer',
        ]);

        // Update Product
        $product->update($request->input('product'));

        // Handle image upload for Product
        if ($request->hasFile('product.image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('product.image')->store('products', 'public');
            $product->save(); // Save again to persist image path
        }

        // Update detail model based on category
        $category = $product->category;

        switch ($category) {
            case 'keycap':
                $detail = $product->keycapDetail()->updateOrCreate([], $request->input('keycap'));
                break;
            case 'keyboard':
                $detail = $product->keyboardDetail()->updateOrCreate([], $request->input('keyboard'));
                break;
            case 'switch':
                $detail = $product->switchDetail()->updateOrCreate([], $request->input('switch'));
                break;
            default:
                // No detail model for this category
                break;
        }


        return redirect()->route('admin.products.index')->with('success', 'Product and details updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete image from storage if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product and its details (one-to-one relationships will handle detail deletion if configured correctly in models - e.g., cascadeOnDelete)
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
{
    $query = $request->get('q');
    
    return Product::where('name', 'like', "%{$query}%")
        ->take(5)
        ->get(['id', 'name', 'price', 'image']);
}
}