<?php

namespace Mage2\Catalog;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mage2\Catalog\Models\Category;
use Mage2\System\View\Facades\AdminConfiguration;
use Mage2\System\View\Facades\AdminMenu;

use Mage2\Framework\Support\BaseModule;

class Module extends BaseModule
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();
        //$this->registerAdminConfiguration();
        //$this->registerAdminMenu();
        $this->registerViewPath();
        $this->registerViewComposerData();
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
        require __DIR__.'/routes.php';
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerAdminMenu()
    {
        $adminMenus[] = [
            'label' => 'Category',
            'url'   => route('admin.category.index'),
        ];
        $adminMenus[] = [
            'label' => 'Products',
            'url'   => route('admin.product.index'),
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
            'edit_action' => route('admin.configuration.catalog'),
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
}
