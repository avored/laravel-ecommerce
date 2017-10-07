<?php
namespace Mage2\Ecommerce\Shipping;

use Illuminate\Support\ServiceProvider;

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
    public function register()
    {
        $this->registerShipping();

        $this->app->alias('shipping', 'Mage2\Ecommerce\Shipping\Manager');
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
        return ['shipping', 'Mage2\Ecommerce\Shipping\Manager'];
    }
}