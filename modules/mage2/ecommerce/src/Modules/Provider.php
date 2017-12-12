<?php
namespace Mage2\Ecommerce\Modules;

use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Modules\Facade as Module;

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
    public function register()
    {

        $this->registerModule();
        $this->app->alias('module', 'Mage2\Ecommerce\Modules\Manager');

        $modules = Module::all();
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton('module', function ($app) {
            return new Manager($app['files']);
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', 'Mage2\Ecommerce\Modules\Manager'];
    }
}