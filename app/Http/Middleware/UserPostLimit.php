<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class UserPostLimit
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $key = 'user_' . $user->id . '_post_limit';

        if (Cache::has($key)) {
            return Response::json(['message' => 'Post creation rate limit exceeded. Please try again later.'], 429);
        }

        Cache::put($key, true, 1); // 1 menit
        return $next($request);
    }
}