<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Redirect to the dashboard.
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }
}
