<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CheckoutComposer;
use App\Http\ViewComposers\MyAccountSidebarComposer;
use App\Http\ViewComposers\LayoutAppComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('checkout.index', CheckoutComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('layouts.app', LayoutAppComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
