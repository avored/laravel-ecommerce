<?php

namespace Mage2\Configuration;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\Common\Middleware\Website as WebsiteMiddleware;
use Illuminate\Support\Facades\Auth;
use Mage2\Catalog\Models\Category;
use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\Support\Facades\Session;

class Mage2ConfigurationServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerAdminMenu();
        //$this->registerMiddleware();
        //$this->registerViewComposerData();
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

    public function registerAdminMenu() {
          $adminMenu = [
              'label' => 'Configuration',
              'url' => route('admin.configuration'),
          ];
          AdminMenu::registerMenu($adminMenu);
    }
}
