<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mage2\Admin\Eloquents\Models\Config;


class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer('layouts.app', function ($view) {

            $configTitle = Config::where('key','=','site_page_title')->get()->first();
            $configDesc = Config::where('key','=','site_page_description')->get()->first();

            $title          = $configTitle->value;
            $description    = $configDesc->value;

            $view->with('title', $title);
            $view->with('description', $description);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
