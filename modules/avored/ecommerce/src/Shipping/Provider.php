<?php
namespace AvoRed\Ecommerce\Shipping;

use Illuminate\Support\ServiceProvider;
use AvoRed\Ecommerce\Shipping\Facade as ShippingFacade;

class Provider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
       $this->registerShippingOption();
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerShipping();

        $this->app->alias('shipping', 'AvoRed\Ecommerce\Shipping\Manager');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerShipping()
    {
        $this->app->singleton('shipping', function ($app) {
            return new Manager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['shipping', 'AvoRed\Ecommerce\Shipping\Manager'];
    }


    /**
     * Register Shippiong Option for App.
     *
     * @return void
     */
    protected function registerShippingOption()
    {
        $freeShipping = new FreeShipping();
        ShippingFacade::put($freeShipping->getIdentifier(), $freeShipping);
    }

}