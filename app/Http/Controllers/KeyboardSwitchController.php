<?php

namespace App\Http\Controllers;

use App\Models\KeyboardSwitch;
use Illuminate\Http\Request;

class KeyboardSwitchController extends Controller
{
    /**
     * Display a listing of the keyboard switches.
     */
    public function index()
    {
        $keyboardSwitches = KeyboardSwitch::all();
        return view('keyboard_switches.index', compact('keyboardSwitches'));
    }

    /**
     * Show the form for creating a new keyboard switch.
     */
    public function create()
    {
        return view('keyboard_switches.create');
    }

    /**
     * Store a newly created keyboard switch in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'actuation_force' => 'nullable|integer',
            'bottom_out_force' => 'nullable|integer',
        ]);

        KeyboardSwitch::create($request->all());

        return redirect()->route('keyboard-switches.index')->with('success', 'Keyboard switch created successfully.');
    }

    /**
     * Display the specified keyboard switch.
     */
    public function show(string $id)
    {
        $keyboardSwitch = KeyboardSwitch::findOrFail($id);
        return view('keyboard_switches.show', compact('keyboardSwitch'));
    }

    /**
     * Show the form for editing the specified keyboard switch.
     */
    public function edit(string $id)
    {
        $keyboardSwitch = KeyboardSwitch::findOrFail($id);
        return view('keyboard_switches.edit', compact('keyboardSwitch'));
    }

    /**
     * Update the specified keyboard switch in storage.
     */
    public function update(Request $request, string $id)
    {
        $keyboardSwitch = KeyboardSwitch::findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'actuation_force' => 'nullable|integer',
            'bottom_out_force' => 'nullable|integer',
        ]);

        $keyboardSwitch->update($request->all());

        return redirect()->route('keyboard-switches.index')->with('success', 'Keyboard switch updated successfully.');
    }

    /**
     * Remove the specified keyboard switch from storage.
     */
    public function destroy(string $id)
    {
        $keyboardSwitch = KeyboardSwitch::findOrFail($id);
        $keyboardSwitch->delete();

        return redirect()->route('keyboard-switches.index')->with('success', 'Keyboard switch deleted successfully.');
    }
}