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

        $customers = Customer::all();

        $SalesLocation = Customer::all();

        return Inertia::render('Customers/Index', [
            'customerTypes' => $customerTypes,
            'customers' => $customers,
            'salesLocations' => $SalesLocation,
        ]);
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
        return redirect()->route('customers.index')->with('success', 'Customer type deleted successfully.');
    }
}
