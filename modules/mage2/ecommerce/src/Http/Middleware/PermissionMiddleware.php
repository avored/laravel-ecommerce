<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */


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
