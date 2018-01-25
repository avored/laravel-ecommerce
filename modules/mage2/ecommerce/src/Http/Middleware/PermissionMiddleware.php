<?php
namespace Mage2\UserRole\Middleware;

use Closure;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Mage2\User\Models\Permission as PermissionModel;

class PermissionMiddleware
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

        if(in_array($permissionName, ['admin.login','admin.login.post',
                                        'admin.password.reset.token', 'admin.password.email.post',
                                        'admin.password.reset.token', 'admin.password.reset'
                                        ])) {
            return $next($request);
        }

        if (Auth::guard($guard)->user()->is_super_admin == 1) {
            return $next($request);
        }

        $permissionName = $request->route()->getName();

        $permission = PermissionModel::where('name', '=', $permissionName)->first();


        if ($permission != NULL && Auth::guard($guard)->user()->cannot('hasPermission', [AdminUser::class, $permissionName])) {
            throw new \Exception('User Don\'t have permissions', 401);
        }

        return $next($request);
    }
}
