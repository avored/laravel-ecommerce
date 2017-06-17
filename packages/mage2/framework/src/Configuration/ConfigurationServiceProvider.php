<?php
namespace Mage2\Framework\Configuration;

use Mage2\Framework\Configuration\ConfigurationManager;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{

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
        $this->registerAdminConfiguration();
        $this->app->alias('adminconfiguration', 'Mage2\Framework\Configuration\ConfigurationManager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        $this->app->singleton('adminconfiguration', function ($app) {
            return new ConfigurationManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adminconfiguration', 'Mage2\Framework\Configuration\ConfigurationManager'];
    }
}