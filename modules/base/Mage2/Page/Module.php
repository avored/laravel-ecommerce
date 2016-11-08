<?php

namespace Mage2\Page;

use Illuminate\Support\Facades\View;
use Mage2\Framework\System\View\Facades\AdminMenu;
use Mage2\Framework\Support\Facades\Permission;
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
        $this->registerPermissions();
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
            'label' => 'Pages',
            'route'   => 'admin.page.index',
        ];
        AdminMenu::registerMenu($adminMenu);
    }

     
    
    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {
        $permissions = [
            ['title' => 'Order List',     'routes' => 'admin.order.index'],
            ['title' => 'Order View, Send Email Invoice to Customer',   'routes' => "admin.order.view,admin.order.send-email-invoice"],
            ['title' => 'Order Update Status',     'routes' => "admin.order.change-status,admin.order.update-status"],
            
           
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }
}
