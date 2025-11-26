<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company_id ? \App\Models\Company::find(Auth::user()->company_id) : null;

        return Inertia::render('Dashboard', [
            'company' => $company,
            'message' => 'Welcome to MASSA Farms Sales Management System',
        ]);
    }
}
