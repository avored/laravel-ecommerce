<?php

namespace AvoRed\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminApiAuth
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
        if (Auth::guard($guard)->guest()) {
            return JsonResponse::create(['message' => 'you are not authorized to access this api', 'status' => false], 401);
        }

        $user = Auth::user();
        if (isset($user->language) && ! empty($user->language)) {
            App::setLocale($user->language);
        }

        return $next($request);
    }
}
