<?php
namespace AvoRed\CashOnDelivery;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Support\Facades\Payment;

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
        $this->publishFiles();
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
     * Registering avored cash-on-delivery Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        //$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        //$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-cash-on-delivery');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'a-cash-on-delivery');
    }

    /**
     * Register Shippiong Option for App.
     *
     * @return void
     */
    protected function registerPaymentOption()
    {
        $payment = new CashOnDelivery();
        Payment::put($payment);
    }

    /**
     * Publish Files for AvoRed Banner Modules.
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../dist/js' => public_path('avored-admin/js'),
        ]);
    }
}
