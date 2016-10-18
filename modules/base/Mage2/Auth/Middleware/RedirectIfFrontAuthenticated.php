<?php

namespace Mage2\Auth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfFrontAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/my-account');
        }

        return $next($request);
    }
}
