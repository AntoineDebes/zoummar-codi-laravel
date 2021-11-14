<?php

namespace App\Http\Middleware;

use Closure;
use http\Message;
use Illuminate\Http\Request;
use function auth;
use function response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('user')->check()){
            return $next($request);
        }
        return response()->json([
            'message'=>"You must be logged in"
        ]);
    }
}
