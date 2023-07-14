<?php

namespace App\Http\Middleware;

use Closure;

class BasicUserOnlySanctum
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has basic user role
        if ($request->user() && $request->user()->user_role === 0) {
            return $next($request);
        }

        // If not basic user, return unauthorized response
        return response()->json(['message' => 'Unauthorized.'], 401);
    }
}
