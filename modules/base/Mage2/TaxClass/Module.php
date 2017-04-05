<?php

namespace Mage2\TaxClass;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;


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
        $this->registerAdminConfiguration();
        $this->registerAdminMenu();
        $this->registerTranslationPath();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->registerWebRoute();
        $this->registerViewPath();

    }

    protected function registerTranslationPath() {
        $this->loadTranslationsFrom(__DIR__. "/views/lang", "mage2tax-class");
    }


    protected function registerViewPath() {
        $this->loadViewsFrom(__DIR__ . '/views', 'mage2taxclass');
        //View::addLocation(__DIR__ . '/views');
    }

    protected function registerWebRoute() {
        require (__DIR__ . "/routes/web.php");
    }

    public function registerAdminConfiguration() {
        $adminConfigurations[] = [
            'title' => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => 'admin.configuration.tax-class',
            'sort_order' => 3
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }


    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [

            /**
            ['title' => 'Role List', 'routes' => 'admin.role.index'],
            ['title' => 'Role Create', 'routes' => "admin.role.create,admin.role.store"],
            ['title' => 'Role Edit', 'routes' => "admin.role.edit,admin.role.update"],
            ['title' => 'Role Destroy', 'routes' => "admin.role.destroy"],
             */
            ['title' => 'Admin User List', 'routes' => 'admin.admin-user.index'],
            ['title' => 'Admin User Create', 'routes' => "admin.admin-user.create,admin.admin-user.store"],
            ['title' => 'Admin User  Edit', 'routes' => "admin.admin-user.edit,admin.admin-user.update"],
            ['title' => 'Admin User  Destroy', 'routes' => "admin.admin-user.destroy"],
        ];

        foreach ($permissions as $permission) {
            PermissionFacade::add($permission);
        }
    }

    public function registerAdminMenu() {

        $orderStatusMenu = [ 'sale' => ['submenu' => [ 'tax-rule' => [
            'label' => 'TaxRule',
            'route' => 'admin.tax-rule.index',
        ]]]];
        AdminMenu::registerMenu('mage2-order', $orderStatusMenu);
    }


    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 TaxClass';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-taxclass';
    }
    
    public function getPath() {
        return __DIR__;
    }

}
