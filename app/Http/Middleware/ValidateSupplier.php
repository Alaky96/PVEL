<?php

namespace App\Http\Middleware;

use Closure;

class ValidateSupplier
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
        if(!((auth()->user()->type === "su") || (auth()->user()->type === "ad")))
            abort(403);
        return $next($request);
    }
}
