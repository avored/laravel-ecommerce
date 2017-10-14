<?php
namespace Mage2\Ecommerce\Theme;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Mage2\Framework\Theme\Facades\Theme;
use Mage2\Framework\Theme\ThemeService;

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
        $this->registerTheme();
        $this->app->alias('theme', 'Mage2\Ecommerce\Theme\Manager');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app->singleton('theme', function ($app) {
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
        return ['theme', 'Mage2\Ecommerce\Theme\Manager'];
    }
}