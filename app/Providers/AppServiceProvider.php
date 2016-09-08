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
        view()->composer('*', function ($view) {

            $configTitle = Config::where('key','=','site_page_title')->get()->first();
            $configDesc = Config::where('key','=','site_page_description')->get()->first();

            $title          = (isset($configTitle->value)) ? $configTitle->value : "Mage2 Ecommerce";
            $description    = (isset($configDesc->value)) ? $configDesc->value : "Mage2 Ecommerce Laravel5 App";

            $title          = (isset($view->title)) ? $view->title : $title;
            $description    = (isset($view->description)) ? $view->description : $description;

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
