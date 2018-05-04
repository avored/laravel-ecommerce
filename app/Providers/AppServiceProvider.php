<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CheckoutComposer;
use App\Http\ViewComposers\MyAccountSidebarComposer;
use App\Http\ViewComposers\LayoutAppComposer;
use AvoRed\Framework\Menu\Facade as MenuFacade;
use AvoRed\Framework\Menu\Menu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerFrontMenu();
        $this->registerViewComposerData();
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



    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerFrontMenu()
    {
        MenuFacade::make('my-account',function (Menu $accountMenu){
            $accountMenu->label('My Account')
                ->route('my-account.home');
        });

        MenuFacade::make('cart',function (Menu $accountMenu){
            $accountMenu->label('Cart')
                ->route('cart.view');
        });


        MenuFacade::make('checkout',function (Menu $accountMenu){
            $accountMenu->label('Checkout')
                ->route('checkout.index');
        });

    }

    /**
     * Registering Class Based View Composer.
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('checkout.index', CheckoutComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('layouts.app', LayoutAppComposer::class);

    }

}
