<?php

namespace AvoRed\Pickup;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Payment\Facade as PaymentFacade;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;
use AvoRed\Pickup\Payment\Pickup;

class Module extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerPaymentOption();
        $this->registerAdminConfiguration();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-pickup');
    }
    
    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        
        $paymentGroup = AdminConfigurationFacade::get('payment')
                ->label('Payment');
        
        $paymentGroup->addConfiguration('payment_pickup_enabled')
                ->label('Payment Pickup Enabled')
                ->type('select')
                ->name('payment_pickup_enabled')
                ->options(function (){
                    $options = [1 => 'Yes' , 0 => 'No'];
                    return $options;
                });
    }
    
    /**
     * Register Payment Option for App.
     *
     * @return void
     */
    protected function registerPaymentOption()
    {
        $payment = new Pickup();
        PaymentFacade::put($payment->identifier(), $payment);
    }

}
