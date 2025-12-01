<?php

namespace App\Http\Controllers;

use App\Models\SalesAgent;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\SalesLocation;
use App\Models\User;
use App\Http\Controllers\Auth\RegisteredUserController;
use Spatie\Permission\Models\Role;

class SalesAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesAgents = SalesAgent::with(['salesLocation', 'user'])->get();
        
        return Inertia::render('Sales/Index', [
            'salesAgents' => $salesAgents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $RegisteredUserController = new RegisteredUserController();

        $role = Role::where('name', 'sales_agent')->first();

        $user = $RegisteredUserController->register($request, $role->id);

        $request->merge(['user_id' => $user->id]);

        $validated = $request->validate([
            'position' => 'nullable|string|max:255',
            'sales_location_id' => 'required|exists:sales_locations,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $salesAgent = SalesAgent::create($validated);

        return redirect()->route('sales.index')->with('success', 'Sales agent created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesAgent $salesAgent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|email|unique:sales_agents,email,' . $salesAgent->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'sales_location_id' => 'required|exists:sales_locations,id',
        ]);

        $salesAgent->update($validated);
        return redirect()->route('sales.index')->with('success', 'Sales agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesAgent $salesAgent)
    {
        $salesAgent->delete();
        return redirect()->route('sales.index')->with('success', 'Sales agent deleted successfully.');
    }
}
