<?php

namespace App\Http\Controllers;

use App\Models\Keycap;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Keyboard;
use App\Models\KeyboardSwitch;
class AdminKeycapController extends Controller
{
    /**
     * Display a listing of the keycaps.
     */
    public function index()
    {
        $keycaps = Keycap::all(); // Or you might want to fetch products with category 'keycap' for a more general product listing
        return view('admin.keycaps.index', compact('keycaps'));
    }

    /**
     * Show the form for creating a new keycap.
     */
    public function create()
    {
        $category = 'keycap'; // Set category specifically for Keycap creation
        $keycap = new Keycap(); // Pass empty instances of detail models for the form (even if only keycap is used)
        $keyboard = new Keyboard();
        $switch = new KeyboardSwitch();
        return view('admin.keycaps.create', compact('keycap', 'keyboard', 'switch', 'category')); // Pass $category to pre-select in form (though now hidden)
    }

    /**
     * Store a newly created keycap and its related product in storage.
     */
    public function store(Request $request)
    {
        // Validate data for Product and Keycap
        $request->validate([
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string',
            'product.price' => 'required|numeric|min:0',
            'product.stock_quantity' => 'required|integer|min:0',
            'product.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keycap.material' => 'nullable|string|max:255',
            'keycap.profile' => 'nullable|string|max:255',
            'keycap.layout' => 'nullable|string|max:255',
            'keycap.manufacturer' => 'nullable|string|max:255',
        ]);

        // Create Product, forcing category to 'keycap'
        $product = Product::create(array_merge($request->input('product'), ['category' => 'keycap']));

        // Handle image upload
        if ($request->hasFile('product.image')) {
            $product->image = $request->file('product.image')->store('products', 'public');
            $product->save();
        }

        // Create Keycap detail and associate with Product
        $detail = new Keycap($request->input('keycap'));
        $detail->product()->associate($product);
        $detail->save();

        return redirect()->route('admin.keycaps.index')->with('success', 'Keycap and Product created successfully.');
    }

    // Note: show, edit, update, destroy methods are NOT defined here as we are reusing ProductController for these actions.
    // Routes are configured in routes/web.php to point to ProductController for these actions for keycaps.
}