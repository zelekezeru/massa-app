<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crops = Crop::with('cropCategory', 'company')->get();
        return inertia('Crops/Index', compact('crops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Crops/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'crop_categories_id' => 'nullable|exists:crop_categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);
        $crop = Crop::create($validated);
        return redirect()->route('crops.index')->with('success', 'Crop created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crop $crop)
    {
        $crop->load('cropCategory', 'company');
        return inertia('Crops/Show', compact('crop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crop $crop)
    {
        $crop->load('cropCategory', 'company');
        return inertia('Crops/Edit', compact('crop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'crop_categories_id' => 'nullable|exists:crop_categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);
        $crop->update($validated);
        return redirect()->route('crops.index')->with('success', 'Crop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crop $crop)
    {
        $crop->delete();
        return redirect()->route('crops.index')->with('success', 'Crop deleted successfully.');
    }
}
