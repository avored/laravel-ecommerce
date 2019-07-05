<?php
namespace AvoRed\Pickup;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Shipping;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Registering AvoRed Pickup Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        //$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        //$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-pickup');
        //$this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-pickup');
    }

     /**
     * Register Shippiong Option for App.
     * @return void
     */
    protected function registerShippingOption()
    {
        $shipping = new Pickup();
        Shipping::put($shipping);
    }
}
