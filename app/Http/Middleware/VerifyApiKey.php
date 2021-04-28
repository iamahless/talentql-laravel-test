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
            $response = ["http_response" => 401, ["error" => "Unauthenticated", "message" => "the api key is wrong/not set"]];
            return json_encode($response, JSON_THROW_ON_ERROR);
        }
        return $next($request);
    }
}
