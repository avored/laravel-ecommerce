<?php
namespace AvoRed\Featured;

use AvoRed\Featured\Widget\Featured\Widget;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Widget\Facade as WidgetFacade;

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
        $this->registerWidget();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-featured');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $featuredProduct = new Widget();
        WidgetFacade::make($featuredProduct->identifier(), $featuredProduct);
    }
}