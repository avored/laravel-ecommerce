<?php
namespace Mage2\Auth;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;

use Mage2\Auth\Middleware\AdminAuthenticate;
use Mage2\Auth\Middleware\RedirectIfAdminAuthenticated;
use Mage2\Auth\Middleware\FrontAuthenticate;
use Mage2\Auth\Middleware\RedirectIfFrontAuthenticated;


class Mage2AuthServiceProvider extends ServiceProvider {

    /**
     * Bootstrap mage2 auth module services.
     *
     * @return void
     */
    public function boot() {

       
    }

    /**
     * Register mage2 auth module services.
     *
     * @return void
     */
    public function register() {
        $this->registerMiddleware();
        $this->mapWebRoutes();
        $this->registerAdminMenu();
        $this->registerViewPath();
       
    }

    /**
     * Include the "web" routes files for the mage2 auth module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        require (__DIR__ . '/routes.php');
    }


    /**
     * Register the view path for the mage2 auth modules.
     *
     * @return void
     */
    protected function registerViewPath() {
        View::addLocation(__DIR__ . "/views");
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware() {
        $router = $this->app['router'];

        $router->middleware('adminauth', AdminAuthenticate::class);
        $router->middleware('adminguest', RedirectIfAdminAuthenticated::class);
        $router->middleware('frontauth', FrontAuthenticate::class);
        $router->middleware('frontguest', RedirectIfFrontAuthenticated::class);
    }



    /**
     * Register admin menu for the mage2 auth modules.
     *
     * @return void
     */
    public function registerAdminMenu() {
        

        //$adminMenu = [
        //    'label' => 'Products',
        //    'url' => route('admin.product.index'),
        //];
        //AdminMenu::registerMenu($adminMenu);
    }

   
}
