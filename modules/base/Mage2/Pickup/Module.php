<?php

namespace Mage2\Pickup;

use Illuminate\Support\Facades\View;
use Mage2\System\Payment\Facade\Payment;
use Mage2\System\View\Facades\AdminMenu;
use Mage2\Pickup\Payment\Pickup;

use Mage2\Framework\Support\BaseModule;

class Module extends BaseModule
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPaymentMethod();
        $this->registerAdminMenu();
        $this->registerViewPath();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function registerPaymentMethod()
    {
        $pickup = new Pickup();
        Payment::put($pickup->getIdentifier(), $pickup);
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerAdminMenu()
    {



        //AdminMenu::registerMenu($adminMenu);
    }
}
