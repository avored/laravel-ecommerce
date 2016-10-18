<?php

namespace Mage2\Auth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = "admin")
    {

        if (Auth::guard($guard)->check()) {
            return redirect('/admin');
        }

        return $next($request);
    }
}
