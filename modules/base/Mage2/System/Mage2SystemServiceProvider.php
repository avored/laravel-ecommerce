<?php

namespace Mage2\System;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminConfiguration;
use Mage2\Framework\View\Facades\AdminMenu;
use Mage2\System\Middleware\EncryptCookies;
use Mage2\System\Middleware\VerifyCsrfToken;
use Mage2\System\Middleware\Website as WebsiteMiddleware;

class Mage2SystemServiceProvider extends ServiceProvider
{
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
        $this->registerMiddleware();
        //$this->mapWebRoutes();
        //$this->registerAdminMenu();
        //$this->registerAdminConfiguration();
        $this->registerViewPath();
        $this->registerViewComposerData();
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware()
    {

        $router = $this->app['router'];
        $router->middleware('website', WebsiteMiddleware::class);


        //$router = $this->app['router'];

        //$router->middleware('web', EncryptCookies::class);
        //$router->middleware('web', VerifyCsrfToken::class);
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
        $adminMenu = [
            'label' => 'Tax Class',
            'url'   => route('admin.tax-class.index'),
        ];
        AdminMenu::registerMenu($adminMenu);
    }

    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title'       => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => route('admin.configuration.tax-class'),
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }


    public function registerViewComposerData()
    {
        view()->composer(['layouts.admin', 'template.header-nav'], function ($view) {
            $user = Auth::guard('admin')->user();
            $view->with('user', $user);
        });


        view()->composer('*', function ($view) {
            $view->with('isDefaultWebsite', Session::get('is_default_website'));
        });

        view()->composer(['my-account.sidebar'], function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });


        view()->composer('admin.catalog.product.boxes.inventory', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $trackStockOptions = $productAttrobuteModel->getTrackStockOptions();
            $inStockOptions = $productAttrobuteModel->getInStockOptions();

            $view
                ->with('trackStockOptions', $trackStockOptions)
                ->with('inStockOptions', $inStockOptions);
        });
        view()->composer('admin.catalog.product.boxes.basic', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $isFeaturedOptions = $productAttrobuteModel->getIsFeaturedOptions();
            $statusOptions = $productAttrobuteModel->getStatusOptions();
            $view
                ->with('isFeaturedOptions', $isFeaturedOptions)
                ->with('statusOptions', $statusOptions);
        });
        view()->composer('admin.catalog.product.boxes.inventory', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $isTaxableOptions = $productAttrobuteModel->getIsTaxableOptions();
            $view
                ->with('isTaxableOptions', $isTaxableOptions);
        });

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
