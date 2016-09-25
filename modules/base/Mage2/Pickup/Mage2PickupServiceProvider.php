<?php

namespace Mage2\Pickup;

use Mage2\Framework\Payment\Facade\Payment;
use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\Pickup\Payment\Pickup;

class Mage2PickupServiceProvider extends ServiceProvider {

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
        $this->registerPaymentMethod();
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
    protected function registerPaymentMethod() {
        $pickup = new Pickup();
        Payment::put($pickup->getIdentifier(), $pickup);
    }


    protected function registerViewPath() {
        View::addLocation(__DIR__ . "/views");
    }
    
    public function registerAdminMenu() {
        

      
        //AdminMenu::registerMenu($adminMenu);
    }

   
}
