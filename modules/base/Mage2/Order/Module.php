<?php

namespace Mage2\Order;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Support\Facades\Permission;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

class Module extends BaseModule {

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
    public function boot() {
        $this->registerModule();
        $this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
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
    protected function mapWebRoutes() {
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {
        $adminMenu = [ 'sale' => [
                'label' => 'Sales',
                'route' => '#'
        ]];
        AdminMenu::registerMenu('mage2-order', $adminMenu);
        $adminMenu = ['sale' => [ 'submenu' => [ 'order' => [
                        'label' => 'Orders',
                        'route' => 'admin.order.index',
        ]]]];
        AdminMenu::registerMenu('mage2-order', $adminMenu);
        $orderStatusMenu = [ 'sale' => ['submenu' => [ 'order-status' => [
                        'label' => 'Order Status',
                        'route' => 'admin.order-status.index',
        ]]]];
        AdminMenu::registerMenu('mage2-order', $orderStatusMenu);
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [
            ['title' => 'Order Status List', 'routes' => 'admin.order-status.index'],
            ['title' => 'Order Status Create', 'routes' => "admin.order-status.create,admin.order-status.store"],
            ['title' => 'Order Status Update', 'routes' => "admin.order-status.edit,admin.order-status.update"],
            ['title' => 'Order Status Destroy', 'routes' => "admin.order-status.destroy"],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 Order';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-order';
    }

}
