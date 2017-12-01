<?php
namespace Mage2\Ecommerce\Theme;

use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Theme\Facade as Theme;

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

        $themes = Theme::all();
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app->singleton('theme', function ($app) {
            $loadDefaultLangPath = base_path('themes/mage2/default/lang');
            $app['path.lang'] = $loadDefaultLangPath;

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