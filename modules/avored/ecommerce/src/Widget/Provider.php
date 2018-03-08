<?php

namespace Mage2\Ecommerce\Widget;

use Mage2\Ecommerce\Widget\Facade as WidgetFacade;
use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Widget\TotalUser\Widget as TotalUserWidget;
use Mage2\Ecommerce\Widget\TotalOrder\Widget as TotalOrderWidget;

class Provider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerWidget();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerServices();
        $this->app->alias('widget', 'Mage2\Ecommerce\Widget\Manager');


    }

    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('widget', function ($app) {
            return new Manager();
        });
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {

        $totalUserWidget = new TotalUserWidget();
        WidgetFacade::make($totalUserWidget->identifier(), $totalUserWidget);

        $totalOrderWidget = new TotalOrderWidget();
        WidgetFacade::make($totalOrderWidget->identifier(), $totalOrderWidget);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['widget', 'Mage2\Ecommerce\Widget\Manager'];
    }
}