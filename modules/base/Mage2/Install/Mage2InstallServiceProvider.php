<?php

namespace Mage2\Install;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;

class Mage2InstallServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        //$this->registerMiddleware();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mapWebRoutes();
        $this->registerAdminMenu();
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
        return true;

        $adminMenu = [
            'label' => 'Pages',
            'url' => route('admin.page.index'),
        ]; 
        AdminMenu::registerMenu($adminMenu);
    }

}
