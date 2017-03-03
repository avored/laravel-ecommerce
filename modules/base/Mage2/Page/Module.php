<?php

namespace Mage2\Page;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Auth\Facades\Permission;
use Mage2\Framework\Support\BaseModule;
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
        $this->registerTranslationPath();

    }

    protected function registerTranslationPath() {
        $this->loadTranslationsFrom(__DIR__. "/views/lang", "mage2user");
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
        $this->loadViewsFrom(__DIR__. '/views', 'mage2page');
        //View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {
        $adminMenu = [ 'page' => [
                'label' => 'Pages',
                'route' => 'admin.page.index',
        ]];
        AdminMenu::registerMenu('mage2-page', $adminMenu);
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [
            ['title' => 'Order List', 'routes' => 'admin.order.index'],
            ['title' => 'Order View, Send Email Invoice to Customer', 'routes' => "admin.order.view,admin.order.send-email-invoice"],
            ['title' => 'Order Update Status', 'routes' => "admin.order.change-status,admin.order.update-status"],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 Page';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-page';
    }

    public function getPath() {
        return __DIR__;
    }
}
