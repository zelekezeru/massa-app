<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\CropCategory;
use Illuminate\Http\Request;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crops = Crop::with('cropCategory', 'company')->get();

        $cropCategories = CropCategory::all();

        $farms = auth()->user()->company->farms;    

        return inertia('Crops/Index', compact('crops', 'cropCategories', 'farms'));
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
        ]);
        $crop = Crop::create($validated);
        return redirect()->route('crops.index')->with('success', 'Crop created successfully.');
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
