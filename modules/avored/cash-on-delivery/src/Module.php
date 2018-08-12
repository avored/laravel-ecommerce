<?php

namespace AvoRed\CashOnDelivery;

use Illuminate\Support\ServiceProvider;
use AvoRed\CashOnDelivery\Payment\CashOnDelivery;
use AvoRed\Framework\Payment\Facade as PaymentFacade;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;

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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-cash-on-delivery');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-fixed-rate');
       
    }
    
    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        
        $paymentGroup = AdminConfigurationFacade::get('payment');
        
        $paymentGroup->addConfiguration('payment_cash_on_delivery_enabled')
                                ->label('Is Cash On Delivery Enabled')
                                ->type('select')
                                ->name('payment_cash_on_delivery_enabled')
                                ->options(function (){
                                    $options = [1 => 'Yes' , 0 => 'No'];
                                    return $options;
                                });
        
    }
    
    /**
     * Register Shippiong Option for App.
     *
     * @return void
     */
    protected function registerPaymentOption()
    {
        $payment = new CashOnDelivery();
        PaymentFacade::put($payment->identifier(), $payment);
    }

}
