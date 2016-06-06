<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->navCartFabComposer();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function navCartFabComposer() {
         view()->composer('layouts.nav', function ($view) {
            $cartItems = count(Session::get('products'));
            $view->with('cartItems', $cartItems);
        });
    }
}
