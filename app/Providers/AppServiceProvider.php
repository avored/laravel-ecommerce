<?php

namespace App\Providers;

use App\Http\Composers\NavComposer;
use AvoRed\Framework\Menu\MenuItem;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Menu;
use Barryvdh\Debugbar\Facade;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() != 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = AliasLoader::getInstance();
    
            /*
             * Load third party local providers
             */
            $this->app->register(DebugbarServiceProvider::class);
    
            /*
             * Load third party local aliases
             */
            $loader->alias('Debugbar', Facade::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.nav', NavComposer::class);
        Menu::make('login', function (MenuItem $menu) {
            $menu->label('Login')
                ->type(MenuItem::FRONT)
                ->route('login');
        });
        Menu::make('register', function (MenuItem $menu) {
            $menu->label('Register')
                ->type(MenuItem::FRONT)
                ->route('register');
        });
        Menu::make('cart', function (MenuItem $menu) {
            $menu->label('Cart')
                ->type(MenuItem::FRONT)
                ->route('cart.show');
        });
        Menu::make('checkout', function (MenuItem $menu) {
            $menu->label('Checkout')
                ->type(MenuItem::FRONT)
                ->route('checkout.show');
        });
        Menu::make('logout', function (MenuItem $menu) {
            $menu->label('Logout')
                ->type(MenuItem::FRONT)
                ->route('logout');
        });
        Menu::make('account.dashboard', function (MenuItem $menu) {
            $menu->label('My Account')
                ->type(MenuItem::FRONT)
                ->route('account.dashboard');
        });
        Menu::make('account.order.index', function (MenuItem $menu) {
            $menu->label('My Orders')
                ->type(MenuItem::FRONT)
                ->route('account.order.index');
        });
    }
}
