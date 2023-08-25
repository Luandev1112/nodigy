<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyBearerToken
{
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken()) {
            if ($user = Auth::guard('api')->user()) {
                $request->merge(['user' => $user]);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['message' => 'Bearer token missing'], 401);
        }

        return $next($request);
    }
}
