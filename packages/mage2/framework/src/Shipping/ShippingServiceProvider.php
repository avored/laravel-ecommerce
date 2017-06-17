<?php
namespace Mage2\Framework\Shipping;

use Mage2\Framework\Shipping\ShippingManager;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{

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

        $this->app->alias('shipping', 'Mage2\Framework\Shipping\ShippingManager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerShipping()
    {
        $this->app->singleton('shipping', function ($app) {
            return new ShippingManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['payment', 'Mage2\Framework\Shipping\ShippingManager'];
    }
}