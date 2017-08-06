<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Mage2\Dashboard\Models\Configuration;

class AdminController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    //public $theme;

    public function __construct()
    {

        //@todo make authorisation gate Facade to work with admin users
        config(['auth.defaults.guard' => 'admin']);
        config(['auth.defaults.password' => 'adminuser']);


        if (Schema::hasTable('configurations')) {
            $path = realpath(Configuration::getConfiguration('active_theme_path'));
            //dd($path );
            View::addLocation($path);
        }

        $this->middleware('permission', ['except', ['admin.login', 'admin.logout']]);
    }
}
