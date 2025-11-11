<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'message' => 'Welcome to MASSA Farms Sales Management System',
        ]);
    }
}
