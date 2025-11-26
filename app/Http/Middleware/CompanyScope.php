<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyScope
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        // Set current company context
        app()->instance('company_id', auth()->user()->company_id);
        return $next($request);
    }
}
