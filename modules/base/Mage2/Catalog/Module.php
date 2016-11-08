<?php

namespace Mage2\Catalog;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mage2\Catalog\Models\Category;
use Mage2\Framework\System\View\Facades\AdminConfiguration;
use Mage2\Framework\System\View\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Support\Facades\Permission;

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
        $this->registerAdminConfiguration();
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
        $adminMenus[] = [
            'label' => 'Category',
            'route'   => 'admin.category.index',
        ];
        $adminMenus[] = [
            'label' => 'Products',
            'route'   => 'admin.product.index',
        ];
        foreach ($adminMenus as $adminMenu) {
            AdminMenu::registerMenu($adminMenu);
        }
    }

    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title'       => 'Catalog Configuration',
            'description' => 'Some Description for Catalog Modules',
            'edit_action' => 'admin.configuration.catalog',
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

    public function registerViewComposerData()
    {
        view()->composer('layouts.app', function ($view) {
            //$websiteId = Session::get('website_id');
            //$baseCategories = Category::where('parent_id','=','')
            //                        ->where('website_id','=',$websiteId)
            //                        ->get();

            $cart = count(Session::get('cart'));
            $categoryModel = new Category();
            $baseCategories = $categoryModel->getAllCategories();
            $view->with('categories', $baseCategories)
                ->with('cart', $cart);
        });
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {
        $permissions = [
            ['title' => 'Category List',     'routes' => 'admin.category.index'],
            ['title' => 'Category Create',   'routes' => "admin.category.create,admin.category.store"],
            ['title' => 'Category Edit',     'routes' => "admin.category.edit,admin.category.update"],
            ['title' => 'Category Destroy',  'routes' => "admin.category.destroy"],
            
            ['title' => 'Product List',     'routes' => 'admin.product.index,admin.product.search'],
            ['title' => 'Product Create ',  'routes' => "admin.product.create,admin.product.store,admin.product.upload-image"],
            ['title' => 'Product Edit',     'routes' => "admin.product.edit,admin.product.update,admin.product.search,admin.product.upload-image"],
            ['title' => 'Product Destroy',  'routes' => "admin.product.destroy",'admin.product.search'],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }
}
