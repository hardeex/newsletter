<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottleMiddleware
{
    public function handle(Request $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $key = $this->resolveRequestSignature($request);
        $attempts = Cache::get($key, 0);

        if ($attempts >= $maxAttempts) {
            return response()->json([
                'message' => 'You have exceeded the allowed number of requests. Please try again later.'
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        // Increment the attempt count and set expiration time
        Cache::put($key, $attempts + 1, $decayMinutes * 60);  // Store in cache for decay time in minutes

        return $next($request);
    }

    private function resolveRequestSignature(Request $request)
    {
        return 'throttle:' . sha1($request->ip());  // Cache key based on IP
    }
}
