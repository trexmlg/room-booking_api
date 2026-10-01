<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $providedKey = $request->header('X-API-Key');
        $expectedKey = env('API_KEY');

        if (!$expectedKey) {
            return response()->json([
                'message' => 'API key is not configured on the server.',
            ], 500);
        }

        if (!$providedKey || !hash_equals($expectedKey, (string) $providedKey)) {
            return response()->json([
                'message' => 'Invalid or missing API key.',
            ], 401);
        }

        return $next($request);
    }
}