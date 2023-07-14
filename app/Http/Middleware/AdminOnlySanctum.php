<?php

namespace App\Http\Middleware;

use Closure;

class AdminOnlySanctum
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has admin role
        if ($request->user() && $request->user()->user_role === 1) {
            return $next($request);
        }

        // If not admin, return unauthorized response
        return response()->json(['message' => 'Unauthorized.'], 401);
    }
}
