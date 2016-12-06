<?php

namespace Mage2\FreeShipping;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Shipping\Facades\Shipping;
use Mage2\FreeShipping\Shipping\FreeShipping;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

class Module extends BaseModule {

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
    public function boot() {
        $this->registerModule();
        $this->registerShippingOption();
        $this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

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
    protected function registerShippingOption() {
        $freeShipping = new FreeShipping();
        Shipping::put($freeShipping->getIdentifier(), $freeShipping);
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {
        //AdminMenu::registerMenu($adminMenu);
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this);
    }

    public function getName() {
        return 'Mage2 FreeShipping';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-freeshipping';
    }

}
