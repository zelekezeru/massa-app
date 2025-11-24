<?php

namespace App\Http\Controllers;

use App\Models\SalesLocation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SalesLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesLocations = SalesLocation::all();
        return Inertia::render('SalesLocations/Index', [
            'salesLocations' => $salesLocations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('SalesLocations/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);
        $salesLocation = SalesLocation::create($validated);
        return redirect()->route('sales-locations.index')->with('success', 'Sales location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesLocation $salesLocation)
    {
        return Inertia::render('SalesLocations/Show', [
            'salesLocation' => $salesLocation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesLocation $salesLocation)
    {
        return Inertia::render('SalesLocations/Edit', [
            'salesLocation' => $salesLocation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesLocation $salesLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
        ]);
        $salesLocation->update($validated);
        return redirect()->route('sales-locations.index')->with('success', 'Sales location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesLocation $salesLocation)
    {
        $salesLocation->delete();
        return redirect()->route('sales-locations.index')->with('success', 'Sales location deleted successfully.');
    }
}
