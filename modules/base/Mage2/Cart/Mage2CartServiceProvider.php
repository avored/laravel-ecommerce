<?php

namespace Mage2\Cart;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;

class Mage2CartServiceProvider extends ServiceProvider {

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

        $adminMenus = [
            'label' => 'Cart',
            'url' => route('cart.view'),
        ];


        //AdminMenu::registerMenu($adminMenu);
    }

   
}
