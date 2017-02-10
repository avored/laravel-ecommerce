<?php

namespace Mage2\Catalog;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Auth\Facades\Permission;
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
        $this->registerAdminConfiguration();
        $this->registerViewPath();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mapWebRoutes();
        $this->registerViewComposerData();
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
        $this->loadViewsFrom(__DIR__ . '/views', 'mage2catalog');
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {

        $adminUserMenu = ['catalog' => [
                'label' => 'Catalog',
                'route' => '#',
                'submenu' => [
                                'category' => [
                                    'label' => 'Category',
                                    'route' => 'admin.category.index',
                                ], 'product' => [
                                    'label' => 'Products',
                                    'route' => 'admin.product.index',
                                ], 'review' => [
                                    'label' => 'Review',
                                    'route' => 'admin.review.index',
                                ]
                            ]
        ]];
        AdminMenu::registerMenu('mage2-catalog', $adminUserMenu);
    }

    public function registerAdminConfiguration() {
        $adminConfigurations[] = [
            'title' => 'Catalog Configuration',
            'description' => 'Some Description for Catalog Modules',
            'edit_action' => 'admin.configuration.catalog',
            'sort_order' => 1
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

    public function registerViewComposerData() {
        View::composer(['admin.catalog.product.boxes.inventory'], 'Mage2\Catalog\ViewComposers\ProductBoxInventoryComposer');
        View::composer(['admin.catalog.product.boxes.basic'], 'Mage2\Catalog\ViewComposers\ProductBoxBasicComposer');
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [
            ['title' => 'Category List', 'routes' => 'admin.category.index'],
            ['title' => 'Category Create', 'routes' => "admin.category.create,admin.category.store"],
            ['title' => 'Category Edit', 'routes' => "admin.category.edit,admin.category.update"],
            ['title' => 'Category Destroy', 'routes' => "admin.category.destroy"],
            ['title' => 'Product List', 'routes' => 'admin.product.index,admin.product.search'],
            ['title' => 'Product Create ', 'routes' => "admin.product.create,admin.product.store,admin.product.upload-image"],
            ['title' => 'Product Edit', 'routes' => "admin.product.edit,admin.product.update,admin.product.search,admin.product.upload-image"],
            ['title' => 'Product Destroy', 'routes' => "admin.product.destroy", 'admin.product.search'],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 Catalog';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-catalog';
    }
    
    public function getPath() {
        return __DIR__;
    }

}
