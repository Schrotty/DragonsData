<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserAuth
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
        if (!$request->user()->isAdmin()) abort(403, 'Access Denied!');

        return $next($request);
    }
}
