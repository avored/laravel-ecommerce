<?php
namespace Mage2\Ecommerce\Payment;

use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Payment\Facade as PaymentFacade;

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
        $this->registerPaymentOptions();
    }




    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPayment();

        $this->app->alias('payment', 'Mage2\Ecommerce\Payment\Manager');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerPayment()
    {
        $this->app->singleton('payment', function ($app) {
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
        return ['payment', 'Mage2\Ecommerce\Payment\Manager'];
    }

    /**
     * Registering PAyment Option for the App.
     *
     *
     * @return void
     */
    protected function registerPaymentOptions()
    {
        $pickup = new Pickup();
        PaymentFacade::put($pickup->getIdentifier(), $pickup);
    }
}