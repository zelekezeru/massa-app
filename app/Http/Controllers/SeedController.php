<?php

namespace App\Http\Controllers;

use App\Models\Seed;
use Illuminate\Http\Request;

class SeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seeds = Seed::where('company_id', auth()->user()->company_id)
            ->latest()
            ->paginate(15);
        return inertia('Seeds/Index', [
            'seeds' => $seeds
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Seeds/Create');
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
            // Add other fields as needed
        ]);
        $validated['company_id'] = auth()->user()->company_id;
        $seed = Seed::create($validated);
        return redirect()->route('seeds.index')->with('success', __('Seed created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Seed $seed)
    {
        $this->authorizeSeed($seed);
        return inertia('Seeds/Show', [
            'seed' => $seed
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seed $seed)
    {
        $this->authorizeSeed($seed);
        return inertia('Seeds/Edit', [
            'seed' => $seed
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seed $seed)
    {
        $this->authorizeSeed($seed);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            // Add other fields as needed
        ]);
        $seed->update($validated);
        return redirect()->route('seeds.index')->with('success', __('Seed updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seed $seed)
    {
        $this->authorizeSeed($seed);
        $seed->delete();
        return redirect()->route('seeds.index')->with('success', __('Seed deleted successfully.'));
    }

    /**
     * Authorize the specified resource for multi-tenant access control.
     */
    private function authorizeSeed(Seed $seed)
    {
        if ($seed->company_id !== auth()->user()->company_id) {
            abort(403);
        }
    }
}
