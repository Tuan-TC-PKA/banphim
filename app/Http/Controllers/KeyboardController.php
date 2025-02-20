<?php

namespace App\Http\Controllers;

use App\Models\Keyboard;
use Illuminate\Http\Request;

class KeyboardController extends Controller
{
    /**
     * Display a listing of the keyboards.
     */
    public function index()
    {
        $keyboards = Keyboard::all();
        return view('keyboards.index', compact('keyboards'));
    }

    /**
     * Show the form for creating a new keyboard.
     */
    public function create()
    {
        return view('keyboards.create');
    }

    /**
     * Store a newly created keyboard in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'layout' => 'nullable|string|max:255',
            'case_material' => 'nullable|string|max:255',
            'pcb_type' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        Keyboard::create($request->all());

        return redirect()->route('keyboards.index')->with('success', 'Keyboard created successfully.');
    }

    /**
     * Display the specified keyboard.
     */
    public function show(string $id)
    {
        $keyboard = Keyboard::findOrFail($id);
        return view('keyboards.show', compact('keyboard'));
    }

    /**
     * Show the form for editing the specified keyboard.
     */
    public function edit(string $id)
    {
        $keyboard = Keyboard::findOrFail($id);
        return view('keyboards.edit', compact('keyboard'));
    }

    /**
     * Update the specified keyboard in storage.
     */
    public function update(Request $request, string $id)
    {
        $keyboard = Keyboard::findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'layout' => 'nullable|string|max:255',
            'case_material' => 'nullable|string|max:255',
            'pcb_type' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
        ]);

        $keyboard->update($request->all());

        return redirect()->route('keyboards.index')->with('success', 'Keyboard updated successfully.');
    }

    /**
     * Remove the specified keyboard from storage.
     */
    public function destroy(string $id)
    {
        $keyboard = Keyboard::findOrFail($id);
        $keyboard->delete();

        return redirect()->route('keyboards.index')->with('success', 'Keyboard deleted successfully.');
    }
}