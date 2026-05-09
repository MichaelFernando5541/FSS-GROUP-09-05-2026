<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Grab all items from the database
    $items = \App\Models\Item::all();
    
    // Send those items to a visual screen (view) named 'items.index'
    return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
 public function create()
{
    return view('items.create');
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        // 1. Verifikasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'modal' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // 2. Simpan ke database
        \App\Models\Item::create($validated);

        // 3. Kembali ke dashboard
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
