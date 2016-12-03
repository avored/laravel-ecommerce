<?php

namespace Mage2\Pickup;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Payment\Facades\Payment;
use Mage2\Pickup\Payment\Pickup;

use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

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
        $this->registerModule();
            //$this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPaymentMethod();
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
    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }


    public function getName() {
        return 'Mage2 Pickup';
    }

    public function getIdentifier() {
        return 'mage2-pickup';
    }
}
