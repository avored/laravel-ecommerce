<?php
namespace Mage2\Framework\Theme;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class ThemeServiceProvider extends ServiceProvider
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

        $this->registerTheme();

        $this->registerThemeNameSpace();

        $this->app->alias('theme', 'Mage2\Framework\Theme\ThemeManager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerTheme()
    {
        $this->app->singleton('theme', function ($app) {
            return new ThemeManager();
        });
    }


    public function registerThemeNameSpace()
    {

        $mage2Module = config('theme');

        foreach ($mage2Module as $namespace => $path) {

            $loader = new ClassLoader();


            $loader->addPsr4($namespace, $path);
            $loader->register();

            App::register($namespace . 'ThemeInfo');

        }
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['theme', 'Mage2\Framework\Theme\ThemeManager'];
    }
}