<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BlockAfterFiveRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            $userKey = 'user_requests:' . auth()->user()->id;
            $requestCount = Cache::get($userKey, 0);

            if ($requestCount >= 5) {
                return response()->json([
                    'message' => 'You have done too many requests.',    
                    'success' => 'false',
                ], 403);
            }
            Cache::increment($userKey);
        }
        return $next($request);
    }
}
