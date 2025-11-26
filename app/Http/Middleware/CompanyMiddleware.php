<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // example logic
        if (! auth()->user() || ! auth()->user()->company_id) {
            abort(403, 'No company assigned.');
        }

        return $next($request);
    }
}
