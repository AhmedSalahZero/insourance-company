<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddJsonHeader
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
        $request->headers->set('Accept','Application/json');
        
        return $next($request);
    }
}
