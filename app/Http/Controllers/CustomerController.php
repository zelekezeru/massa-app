<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SalesLocation;
use App\Models\SalesAgent;
use App\Models\CustomerType;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        $customerTypes = CustomerType::all();

        return Inertia::render('Customers/Index', [
            'customers' => $customers,
            'customerTypes' => $customerTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salesLocations = SalesLocation::all();
        $salesAgents = SalesAgent::with(['salesLocation', 'user'])->get();
        $customerTypes = CustomerType::all();
        
        return Inertia::render('Customers/Create', [
            'salesLocations' => $salesLocations,
            'salesAgents' => $salesAgents,
            'customerTypes' => $customerTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|string|max:50',
            // Add more fields as needed
        ]);
        $customer = Customer::create($data);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Customers/Show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $salesLocations = SalesLocation::all();
        $salesAgents = SalesAgent::with(['salesLocation', 'user'])->get();
        $customerTypes = CustomerType::all();
        
        return Inertia::render('Customers/Edit', [
            'customer' => $customer,
            'salesLocations' => $salesLocations,
            'salesAgents' => $salesAgents,
            'customerTypes' => $customerTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:50',
            // Add more fields as needed
        ]);
        $customer->update($data);
        return redirect()->route('customers.show', $customer)->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
