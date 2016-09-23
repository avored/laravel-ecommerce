<?php

namespace Mage2\Common;

use Mage2\Framework\Support\ServiceProvider;
use Mage2\Framework\View\Facades\AdminMenu;
use Illuminate\Support\Facades\View;
use Mage2\Common\Middleware\AdminAuthenticate;
use Mage2\Common\Middleware\RedirectIfAdminAuthenticated;
use Mage2\Common\Middleware\Website as WebsiteMiddleware;
use Illuminate\Support\Facades\Auth;
use Mage2\Catalog\Models\Category;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Common\Middleware\FrontAuthenticate;
use Mage2\Common\Middleware\RedirectIfFrontAuthenticated;
use Illuminate\Support\Facades\Session;
use Mage2\Common\Console\Commands\Mage2Migrate;

class Mage2CommonServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        $this->registerCommand();

        $this->registerAdminMenu();
        $this->registerMiddleware();
        $this->registerViewComposerData();
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
       

        /*
        $adminMenu = [
            'label' => 'Pages',
            'url' => route('admin.login'),
        ]; 
        AdminMenu::registerMenu($adminMenu);
         * 
         */
    }

    public function registerCommand() {
        $this->commands([Mage2Migrate::class]);
    }

    public function registerMiddleware() {
        $router = $this->app['router'];

        // '' => \Mage2\Auth\Middleware\RedirectIfAdminAuthenticated::class,
        $router->middleware('adminauth', AdminAuthenticate::class);
        $router->middleware('adminguest', RedirectIfAdminAuthenticated::class);
        $router->middleware('frontauth', FrontAuthenticate::class);
        $router->middleware('frontguest', RedirectIfFrontAuthenticated::class);
        $router->middleware('website', WebsiteMiddleware::class);
    }
    
    public function registerViewComposerData() {
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


        view()->composer('product.boxes.inventory', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $trackStockOptions = $productAttrobuteModel->getTrackStockOptions();
            $inStockOptions = $productAttrobuteModel->getInStockOptions();

            $view
                    ->with('trackStockOptions', $trackStockOptions)
                    ->with('inStockOptions', $inStockOptions)

            ;
        });
        view()->composer('product.boxes.basic', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $isFeaturedOptions = $productAttrobuteModel->getIsFeaturedOptions();
            $statusOptions = $productAttrobuteModel->getStatusOptions();
            $view
                    ->with('isFeaturedOptions', $isFeaturedOptions)
                    ->with('statusOptions', $statusOptions)
            ;
        });
        view()->composer('product.boxes.inventory', function ($view) {
            $productAttrobuteModel = new ProductAttribute();
            $isTaxableOptions = $productAttrobuteModel->getIsTaxableOptions();
            $view
                    ->with('isTaxableOptions', $isTaxableOptions)
            ;
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
                    ->with('cart', $cart)
            ;
        });
    }
}
