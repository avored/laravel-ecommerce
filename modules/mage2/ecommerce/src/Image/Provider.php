<?php
namespace Mage2\Ecommerce\Image;

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
        $this->registerImageService();

        $this->app->alias('image', 'Mage2\Ecommerce\Image\Service');
    }
    /**
     * Register the Image Service instance.
     *
     * @return void
     */
    protected function registerImageService()
    {
        $this->app->singleton('image', function ($app) {
            return new Service();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['image', 'Mage2\Ecommerce\Image\Service'];
    }
}