<?php

namespace App\Http\Controllers;

use App\Models\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * Return all markers as JSON (optional API endpoint).
     */
    public function index()
    {
        return Marker::all();
    }

    /**
     * Store a newly created marker in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $marker = Marker::create($validated);

        return response()->json($marker);
    }

    /**
     * Show the interactive map view with markers.
     */
    public function map()
    {
        $markers = Marker::all();
        return view('markers.map', compact('markers'));
    }

    /**
     * Show a table list of all markers.
     */
    public function list()
    {
        $markers = Marker::orderBy('created_at', 'desc')->get();
        return view('markers.list', compact('markers'));
    }

    /**
     * Return a single marker (API).
     */
    public function show(string $id)
    {
        return Marker::findOrFail($id);
    }

    public function edit(string $id)
{
    $marker = Marker::findOrFail($id);
    return view('markers.edit', compact('marker'));
}


    /**
     * Update the specified marker.
     */
    public function update(Request $request, string $id)
    {
        $marker = Marker::findOrFail($id);
        $marker->update($request->all());

        return response()->json($marker);
    }

    /**
     * Remove the specified marker.
     */
    public function destroy(string $id)
{
    $marker = Marker::findOrFail($id);
    $marker->delete();

    return redirect()->route('markers.list')->with('success', 'Marker deleted successfully.');
}

}
