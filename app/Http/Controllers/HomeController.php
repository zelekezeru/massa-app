<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Pages/Home', [
            'users' => User::all(),
        ]);
    }
}