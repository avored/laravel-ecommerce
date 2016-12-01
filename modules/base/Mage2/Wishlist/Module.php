<?php

namespace Mage2\Wishlist;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

class Module extends BaseModule
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap Mage2 Wishlist module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModule();
    }


    /**
     * Register Mage2 Wishlist module services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();
        $this->registerViewPath();
    }

    /**
     * Define the "web" routes for the mage2 wishlist modules.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        require __DIR__.'/routes/web.php';
    }

    /**
     * Define the view path for the mage2 wishlist modules.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this);
    }


    public function getName() {
        return 'Mage2 Wishlist';
    }

    public function getIdentifier() {
        return 'mage2-wishlist';
    }

}
