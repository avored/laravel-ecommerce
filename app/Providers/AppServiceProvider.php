<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Composers\NavComposer;
use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Framework\Menu\MenuItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //   
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
