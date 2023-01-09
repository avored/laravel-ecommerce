<?php
namespace AvoRed\CashOnDelivery;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Payment\Payment;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Tab\TabItem;

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
        $this->registerTab();
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
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'a-cash-on-delivery');
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
            __DIR__ . '/../dist/js' => public_path('vendor/avored/js'),
        ]);
    }

    public function registerTab()
    {
        // Tab::put('system.configuration', function (TabItem $tab) {
        //     $tab->key('system.configuration.cash-on-delivery')
        //         ->label('a-cash-on-delivery::cash-on-delivery.config-title')
        //         ->view('a-cash-on-delivery::system.configuration.payment-card');
        // });
    }
}
