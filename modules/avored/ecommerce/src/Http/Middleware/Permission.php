<?php

namespace AvoRed\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        config(['auth.defaults.guard' => 'admin']);

        $permissionName = $request->route()->getName();

        if (in_array($permissionName, ['admin.login', 'admin.login.post',
                                        'admin.password.reset.token', 'admin.password.email.post',
                                        'admin.password.reset.token', 'admin.password.reset',
                                        ])) {
            return $next($request);
        }

        if (Auth::guard($guard)->user()->is_super_admin == 1) {
            return $next($request);
        }

        $user = Auth::guard('admin')->user();

        if (! $user->hasPermission($permissionName)) {
            throw new \Exception('User Don\'t have permissions', 401);
        }

        return $next($request);
    }
}
