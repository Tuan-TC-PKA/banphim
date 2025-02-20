<?php

namespace App\Http\Controllers;

use App\Models\Keycap;
use App\Models\Product;
use Illuminate\Http\Request;

class KeycapController extends Controller
{
    /**
     * Display a listing of the keycaps.
     */
    public function index()
    {
        $keycaps = Keycap::all();
        return view('keycaps.index', compact('keycaps'));
    }

    /**
     * Show the form for creating a new keycap.
     */
    public function create()
    {
        return view('keycaps.create');
    }

    /**
     * Store a newly created keycap in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'material' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'layout' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        Keycap::create($request->all());

        return redirect()->route('keycaps.index')->with('success', 'Keycap created successfully.');
    }

    /**
     * Display the specified keycap.
     */
    public function show(string $id)
    {
        $keycap = Keycap::findOrFail($id);
        return view('keycaps.show', compact('keycap'));
    }

    /**
     * Show the form for editing the specified keycap.
     */
    public function edit(string $id)
    {
        $keycap = Keycap::findOrFail($id);
        return view('keycaps.edit', compact('keycap'));
    }

    /**
     * Update the specified keycap in storage.
     */
    public function update(Request $request, string $id)
    {
        $keycap = Keycap::findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'material' => 'nullable|string|max:255',
            'profile' => 'nullable|string|max:255',
            'layout' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        $keycap->update($request->all());

        return redirect()->route('keycaps.index')->with('success', 'Keycap updated successfully.');
    }

    /**
     * Remove the specified keycap from storage.
     */
    public function destroy(string $id)
    {
        $keycap = Keycap::findOrFail($id);
        $keycap->delete();

        return redirect()->route('keycaps.index')->with('success', 'Keycap deleted successfully.');
    }
}