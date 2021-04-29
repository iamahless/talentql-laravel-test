<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \JsonException
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->key;
        if ($key !== env('API_AUTH_KEY') || is_null($key)) {
            return response()->json([
                "status" => "error",
                "message" => "Unauthenticated: Key is invalid"
            ], 401);
        }
        return $next($request);
    }
}
