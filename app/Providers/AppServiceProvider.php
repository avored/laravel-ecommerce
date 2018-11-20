<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CheckoutComposer;
use App\Http\ViewComposers\MyAccountSidebarComposer;
use App\Http\ViewComposers\LayoutAppComposer;
use AvoRed\Framework\Menu\Facades\Menu as MenuFacade;
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
        
        MenuFacade::make('cart', function (Menu $menu) {
            $menu->label('Cart')
            ->route('cart.view');
        });
        
        MenuFacade::make('checkout', function (Menu $menu) {
            $menu->label('Checkout')
            ->route('checkout.index');
        });
        
        MenuFacade::make('my-account', function (Menu $menu) {
            $menu->label('My Account')
                ->route('my-account.home');
        });
      
        MenuFacade::make('account_edit', function (Menu $menu) {
            $menu->label('Edit Account')
                ->route('my-account.edit');
        });
        MenuFacade::make('account_upload_image', function (Menu $menu) {
            $menu->label('Upload Image')
                ->route('my-account.upload-image');
        });
        MenuFacade::make('account_order_list', function (Menu $menu) {
            $menu->label('My Orders')
                ->route('my-account.order.list');
        });
        MenuFacade::make('account_addresses', function (Menu $menu) {
            $menu->label('My Addresses')
                ->route('my-account.address.index');
        });
        MenuFacade::make('account_wishlist', function (Menu $menu) {
            $menu->label('My Wishlist')
                ->route('my-account.wishlist.list');
        });
        MenuFacade::make('account_change_password', function (Menu $menu) {
            $menu->label('Change Password')
                ->route('my-account.change-password');
        });
        MenuFacade::make('account_logout', function (Menu $menu) {
            $menu->label('Logout')
                ->route('logout');
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
