<?php
namespace AvoRed\DemoData;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register call here
    }

    /**
     * Registering AvoRed DemoData Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        //$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        //$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-demodata');
        //$this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-demodata');
    }
}
