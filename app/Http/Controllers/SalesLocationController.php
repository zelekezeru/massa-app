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
        return Inertia::render('Sales/Index', [
            'salesLocations' => $salesLocations,
        ]);
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
            'gps_location' => 'nullable|string|max:255',
        ]);
        $salesLocation = SalesLocation::create($validated);
        return redirect()->route('sales.index')->with('success', 'Sales location created successfully.');
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
            'gps_location' => 'nullable|string|max:255',
        ]);
        $salesLocation->update($validated);
        return redirect()->route('sales.index')->with('success', 'Sales location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesLocation $salesLocation)
    {
        $salesLocation->delete();
        return redirect()->route('sales.index')->with('success', 'Sales location deleted successfully.');
    }
}
