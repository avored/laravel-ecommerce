<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Mage2\Admin\Models\Website as WebsiteModel;

class Website
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $host = str_replace("http://","", $request->getUriForPath(""));
        $host = str_replace("https://","", $host);
        $website = WebsiteModel::where('host','=', $host )->get()->first();
        
        Session::put('website_id', $website->id);

        if($website->is_default == 1) {
            Session::put('is_default_website', true);
            Session::put('default_website_id', $website->id);
        } else {
            $defaultWebsite = WebsiteModel::where('is_default','=',1)->get()->first();

            Session::put('is_default_website', false);
            Session::put('default_website_id', $defaultWebsite->id);

        }



        return $next($request);
    }
}
