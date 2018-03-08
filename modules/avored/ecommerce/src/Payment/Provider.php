<?php
namespace AvoRed\Ecommerce\Payment;

use Illuminate\Support\ServiceProvider;
use AvoRed\Ecommerce\Payment\Facade as PaymentFacade;
use AvoRed\Ecommerce\Payment\Pickup\Payment as PickupPayment;
use AvoRed\Ecommerce\Payment\Paypal\Payment as PaypalPayment;
use AvoRed\Ecommerce\Payment\Stripe\Payment as StripePayment;

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

        $this->app->alias('payment', 'AvoRed\Ecommerce\Payment\Manager');
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
        return ['payment', 'AvoRed\Ecommerce\Payment\Manager'];
    }

    /**
     * Registering PAyment Option for the App.
     *
     *
     * @return void
     */
    protected function registerPaymentOptions()
    {
        $pickup = new PickupPayment();
        PaymentFacade::put($pickup->getIdentifier(), $pickup);

        //$paypal = new PaypalPayment();
        //PaymentFacade::put($paypal->getIdentifier(), $paypal);

        $stripe = new StripePayment();
        PaymentFacade::put($stripe->getIdentifier(), $stripe);
    }
}