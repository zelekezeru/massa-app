<?php

namespace App\Http\Controllers;

use App\Models\CropCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CropCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cropCategories = CropCategory::all();
        return Inertia::render('Crops/Index', [
            'cropCategories' => $cropCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CropCategories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = CropCategory::create($validated);

        return redirect()->route('crops.index')->with('success', 'Crop category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CropCategory $cropCategory)
    {
        return Inertia::render('CropCategories/Show', [
            'cropCategory' => $cropCategory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CropCategory $cropCategory)
    {
        return Inertia::render('CropCategories/Edit', [
            'cropCategory' => $cropCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CropCategory $cropCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $cropCategory->update($validated);

        return redirect()->route('crops.index')->with('success', 'Crop category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CropCategory $cropCategory)
    {
        $cropCategory->delete();
        return redirect()->route('crops.index')->with('success', 'Crop category deleted successfully.');
    }
}
