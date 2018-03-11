<?php
namespace AvoRed\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\Visitor as VisitorModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class Visitor
{

    public function handle($request, Closure $next)
    {
        $currentUri = Route::getCurrentRoute()->uri;
        if(strpos($currentUri, 'install') === false) {


            if (Schema::hasTable('visitors')) {
                $url = $request->path();
                $ipAddress = $request->getClientIp();
                $userId = NULL;
                $agent = $request->server('HTTP_USER_AGENT');

                if (Auth::check()) {
                    $userId = Auth::user()->id;
                }

                VisitorModel::create([
                    'url' => $url,
                    'ip_address' => $ipAddress,
                    'user_id' => $userId,
                    'agent' => $agent
                ]);
            }
        }
        return $next($request);


    }
}
