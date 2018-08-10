<?php

namespace AvoRed\FixedRate;

use Illuminate\Support\ServiceProvider;
use AvoRed\FixedRate\Shipping\FixedRate;
use AvoRed\Framework\Shipping\Facade as ShippingFacade;
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
        $this->registerShippingOption();
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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-fixed-rate');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-fixed-rate');
       
    }
    
    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        
        $shippingGroup = AdminConfigurationFacade::get('shipping');
        
        $shippingGroup->addConfiguration('shipping_fixed_rate_shipping_enabled')
                                ->label('Is Fixed Rate Enabled')
                                ->type('select')
                                ->name('shipping_fixed_rate_shipping_enabled')
                                ->options(function (){
                                    $options = [1 => 'Yes' , 0 => 'No'];
                                    return $options;
                                });
        $shippingGroup->addConfiguration('shipping_fixed_rate_cost')
                    ->label('Chaged for Fixed Rate Shipping')
                    ->type('text')
                    ->name('shipping_fixed_rate_cost');
    }
    
    /**
     * Register Shippiong Option for App.
     *
     * @return void
     */
    protected function registerShippingOption()
    {
        $shipping = new FixedRate();
        ShippingFacade::put($shipping->identifier(), $shipping);
    }

}
