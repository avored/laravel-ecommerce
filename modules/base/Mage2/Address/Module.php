<?php

namespace Mage2\Address;

use Illuminate\Support\Facades\View;
use Mage2\System\View\Facades\AdminConfiguration;
use Mage2\Framework\Support\BaseModule;

class Module extends BaseModule
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();
        $this->registerAdminMenu();
        //$this->registerAdminConfiguration();
        $this->registerViewPath();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        require __DIR__.'/routes.php';
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerAdminMenu()
    {


        //$adminMenu = [
        //    'label' => 'Products',
        //    'url' => route('admin.product.index'),
        //];
        //AdminMenu::registerMenu($adminMenu);
    }

    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title'       => 'Address Configuration',
            'description' => 'Set Default Country for Store',
            'edit_action' => route('admin.configuration.address'),
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }
}
