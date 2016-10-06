<?php

namespace Mage2\TaxClass;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\Framework\View\Facades\AdminConfiguration;

class Mage2TaxClassServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
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
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes() {
        require (__DIR__ . '/routes.php');
    }


    protected function registerViewPath() {
        View::addLocation(__DIR__ . "/views");
    }
    
    public function registerAdminMenu() {
        

        $adminMenu = [
            'label' => 'Tax Class',
            'url' => route('admin.tax-class.index'),
        ]; 
        AdminMenu::registerMenu($adminMenu);
    }
    
     public function registerAdminConfiguration() {

        $adminConfigurations[] = [
            'title' => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => route('admin.configuration.tax-class'),
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

   
}
