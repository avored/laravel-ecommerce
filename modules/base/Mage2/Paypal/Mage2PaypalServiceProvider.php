<?php

namespace Mage2\Paypal;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\Framework\Payment\Facade\Payment;
use Mage2\Paypal\Payment\Paypal;
use Mage2\Framework\View\Facades\AdminConfiguration;

class Mage2PaypalServiceProvider extends ServiceProvider {

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
        $this->registerPaymentMethod();
        $this->registerAdminMenu();
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

    protected function mapWebRoutes() {
        require (__DIR__ . '/routes.php');
    }
     */

    protected function mapWebRoutes() {
        require (__DIR__ . '/routes.php');
    }
    protected function registerPaymentMethod() {
        $paypal = new Paypal();
        Payment::put($paypal->getIdentifier(), $paypal);
    }


    protected function registerViewPath() {
        View::addLocation(__DIR__ . "/views");
    }
    
    public function registerAdminMenu() {
        

      
        //AdminMenu::registerMenu($adminMenu);
    }
    
    public function registerAdminConfiguration() {

        $adminConfigurations[] = [
            'title' => 'Paypal Configuration',
            'description' => 'Some Description for Catalog Modules',
            'edit_action' => route('admin.configuration.paypal'),
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

   
}
