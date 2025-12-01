<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = auth()->user()->company->farms;
        return inertia('Farms/Index', compact('farms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'size' => 'nullable|numeric',
            'gps_location' => 'nullable|string|max:255',
        ]);
        
        $farm = Farm::create($validated);

        // Image upload handling
        if ($request->hasFile('image')) {
            imageUpload($farm);
        }

        return redirect()->route('farms.index')->with('success', 'Farm created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'size' => 'nullable|numeric',
            'gps_location' => 'nullable|string|max:255',
        ]);
        $farm->update($validated);

        // Image upload handling
        if ($request->hasFile('image')) {
            imageUpload($farm);
        }
        return redirect()->route('farms.index')->with('success', 'Farm updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        $farm->delete();
        return redirect()->route('farms.index')->with('success', 'Farm deleted successfully.');
    }

    // Image Upload method
    public function imageUpload($farm)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('farm_images', 'public');
            $farm->image = $path;
            $farm->save();
        }

        return $farm;
    }
}
