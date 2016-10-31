<?php

namespace Mage2\System\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mage2\Configuration\Models\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    //public $theme;

    public function __construct()
    {
        
        if (Schema::hasTable('configurations')) {
            $path = realpath(Configuration::getConfiguration('active_theme_path'));
            //dd($path );
            View::addLocation($path);
        }
        $this->middleware(function ($request, $next) {
            $this->websiteId = Session::get('website_id');
            $this->defaultWebsiteId = Session::get('default_website_id');
            $this->isDefaultWebsite = Session::get('is_default_website');

            return $next($request);
        });
    }
}
