<?php

namespace Mage2\TaxClass;

use Illuminate\Support\Facades\View;
use Mage2\System\View\Facades\AdminConfiguration;
use Mage2\System\View\Facades\AdminMenu;

use Mage2\Framework\Support\BaseModule;

class Module extends BaseModule
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
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
        //$this->registerAdminMenu();
        $this->registerAdminConfiguration();
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
        $adminMenu = [
            'label' => 'Tax Class',
            'url'   => route('admin.tax-class.index'),
        ];
        AdminMenu::registerMenu($adminMenu);
    }

    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title'       => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => route('admin.configuration.tax-class'),
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            //AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }
}
