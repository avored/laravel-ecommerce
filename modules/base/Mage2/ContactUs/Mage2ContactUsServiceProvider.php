<?php
namespace Mage2\ContactUs;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;

class Mage2ContactUsServiceProvider extends ServiceProvider {

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

    /*
    public function registerAdminMenu() {
        $adminMenu = [
            'label' => 'Review',
            'url' => route('admin.review.index'),
        ];
        AdminMenu::registerMenu($adminMenu);
    }
    */

   
}
