<?php

namespace App\Http\Middleware;

use Closure;

class AuthApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken() !== env('API_AUTHORIZATION_TOKEN')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token'
            ], 403);
        }

        if (! $request->expectsJson()) {
            return response()->json([
               'status' => 'error',
               'message' => 'Expect Json Response'
            ], 403);
        }

        return $next($request);
    }
}
