<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerTypes = CustomerType::all();
        return Inertia::render('CustomerTypes/Index', [
            'customerTypes' => $customerTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CustomerTypes/Create');
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
        $customerType = CustomerType::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerType $customerType)
    {
        return Inertia::render('CustomerTypes/Show', [
            'customerType' => $customerType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerType $customerType)
    {
        return Inertia::render('CustomerTypes/Edit', [
            'customerType' => $customerType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerType $customerType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $customerType->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerType $customerType)
    {
        $customerType->delete();
        return redirect()->route('customer-types.index')->with('success', 'Customer type deleted successfully.');
    }
}
