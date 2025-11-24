<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
        if (!$user || !$user->can($permission)) {
            abort(403, 'Unauthorized.');
        }
        return $next($request);
    }
}
