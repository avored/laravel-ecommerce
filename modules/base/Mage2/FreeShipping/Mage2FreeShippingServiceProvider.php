<?php

namespace Mage2\FreeShipping;

use Mage2\Framework\Shipping\Facade\Shipping;
use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\FreeShipping\Shipping\FreeShipping;

class Mage2FreeShippingServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->registerShippingOption();
        $this->registerAdminMenu();
        $this->registerViewPath();
       
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function registerShippingOption() {
        $freeShipping = new FreeShipping();
        Shipping::put($freeShipping->getIdentifier(), $freeShipping);
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . "/views");
    }


    public function registerAdminMenu() {
        //AdminMenu::registerMenu($adminMenu);
    }

   
}
