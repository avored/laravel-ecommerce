<?php

namespace Mage2\User;

use Illuminate\Support\Facades\View;
use Mage2\System\View\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\User\Middleware\AdminAuthenticate;
use Mage2\User\Middleware\FrontAuthenticate;
use Mage2\User\Middleware\RedirectIfAdminAuthenticated;
use Mage2\User\Middleware\RedirectIfFrontAuthenticated;


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
        $this->registerMiddleware();
        $this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();

        $this->registerViewPath();
    }
    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        $router = $this->app['router'];

        $router->middleware('adminauth', AdminAuthenticate::class);
        $router->middleware('adminguest', RedirectIfAdminAuthenticated::class);
        $router->middleware('frontauth', FrontAuthenticate::class);
        $router->middleware('frontguest', RedirectIfFrontAuthenticated::class);
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
        require __DIR__.'/routes/web.php';
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerAdminMenu()
    {
        $adminMenu = [
            'label' => 'Users',
            'url'   => route('admin.user.index'),
        ];
        AdminMenu::registerMenu($adminMenu);

        $adminRoleMenu = [
            'label' => 'Roles',
            'url'   => route('admin.role.index'),
        ];
        AdminMenu::registerMenu($adminRoleMenu);
    }
}
