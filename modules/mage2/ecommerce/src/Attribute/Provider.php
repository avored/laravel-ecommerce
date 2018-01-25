<?php
namespace Mage2\Ecommerce\Attribute;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{

    protected $defer = true;


    public function register() {
        $this->registerAttributes();
        $this->app->alias('attributes', 'Mage2\Ecommerce\Attribute\Collection');


    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerAttributes()
    {
        $this->app->singleton('attributes', function ($app) {
            return new Collection();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'attributes',  'Mage2\Ecommerce\Attribute\Collection'];
    }
}
