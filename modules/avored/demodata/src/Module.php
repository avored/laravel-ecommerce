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
        $this->setupPublishFiles();
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


    /**
     * Set up the file which can be published to use the package
     * @return void
     */
    public function setupPublishFiles()
    {
        $this->publishes([
            __DIR__.'/../assets/uploads' => storage_path('app/public/uploads')
        ], 'avored-demo-storage');
    }
}
