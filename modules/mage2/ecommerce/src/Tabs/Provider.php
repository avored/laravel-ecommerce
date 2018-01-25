<?php
namespace Mage2\Ecommerce\Tabs;

use Illuminate\Support\ServiceProvider;

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
        $this->registerTabs();
        $this->app->alias('tabs', 'Mage2\Ecommerce\Tabs\TabsMaker');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerTabs()
    {
        $this->app->singleton('tabs', function () {
            return new TabsMaker();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tabs', 'Mage2\Ecommerce\Tabs\TabsMaker'];
    }
}