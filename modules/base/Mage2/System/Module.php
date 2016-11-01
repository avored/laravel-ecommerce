<?php

namespace Mage2\System;

use Illuminate\Support\Facades\View;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\App;
use Mage2\System\Payment\PaymentManager;
use Mage2\System\Routing\UrlGenerator;
use Mage2\System\Shipping\ShippingManager;
use Mage2\System\Theme\ThemeManager;
use Mage2\System\View\AdminConfiguration;
use Mage2\System\View\AdminMenu;
use Mage2\System\View\Facades\AdminMenu as AdminMenuFacade;
use Mage2\System\Middleware\Website as WebsiteMiddleware;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\Category;
use Illuminate\Support\Facades\Auth;
use Mage2\System\View\FileViewFinder;


use Mage2\Framework\Support\BaseModule;

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

        $this->registerAdminConfigurationManager();
        $this->registerAdminConfigurationFacade();

        $this->registerTheme();
        $this->registerAdminMenuFacade();
        $this->app['request']->server->set('HTTPS', 'off');
        

        View::composer(['layouts.admin-nav','layouts.admin-bootstrap-nav'], function ($view) {
            $adminMenus = (array) AdminMenuFacade::getMenuItems();
            $view->with('adminMenus', $adminMenus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        
        $this->registerMiddleware();
        //$this->mapWebRoutes();
        //$this->registerAdminMenu();
        //$this->registerAdminConfiguration();
        $this->registerViewPath();
        $this->registerViewComposerData();
        $this->_registerShippingFacade();
        //$this->registerUrlGenerator();

        $this->_registerPaymentFacade();
        $this->_registerThemeFacade();
         $this->app->bind('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware() {

        $router = $this->app['router'];
        $router->middleware('website', WebsiteMiddleware::class);


        //$router = $this->app['router'];
        //$router->middleware('web', EncryptCookies::class);
        //$router->middleware('web', VerifyCsrfToken::class);
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu() {
        $adminMenu = [
            'label' => 'Tax Class',
            'url' => route('admin.tax-class.index'),
        ];
        //AdminMenuFacade::registerMenu($adminMenu);
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

      public function registerModule()
    {
        $mage2Module = config('module');
        foreach ($mage2Module as $namespace => $path) {
            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            $extensionProvider = str_replace('\\', '', $namespace.'ServiceProvider');
            App::register($namespace.$extensionProvider);
        }
    }

    public function registerTheme()
    {
        $mage2Module = config('theme');
        foreach ($mage2Module as $namespace => $path) {
            $loader = new ClassLoader();
            $loader->addPsr4($namespace, $path);
            $loader->register();
            //Register ServiceProvider for Modules
            //$extensionProvider = str_replace("\\", "", $namespace. "\\" . "ThemeInfo");
            //dd($namespace . "ThemeInfo");die;
            App::register($namespace.'ThemeInfo');
        }
    }

  

    private function _registerShippingFacade()
    {
        App::bind('Shipping', function () {
            return new ShippingManager();
        });
    }

    /**
     * Get the URL generator request rebinder.
     *
     * @return \Closure
     */
    protected function requestRebinder()
    {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }

    private function _registerPaymentFacade()
    {
        App::bind('Payment', function () {
            return new PaymentManager();
        });
    }

    private function _registerThemeFacade()
    {
        App::bind('Theme', function () {
            return new ThemeManager();
        });
    }

    private function _registerExtensionFacade()
    {
        App::bind('Extension', function () {
            return new ExtensionManager();
        });
    }

    public function registerAdminMenuFacade()
    {
        
        App::bind('AdminMenu', function () {
            return new AdminMenu();
        });
    }

     /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerAdminConfigurationManager()
    {
       $this->app['AdminConfiguration'] = $this->app->share(function($app)
        {
            return new AdminConfiguration();
        });
    }
    public function registerAdminConfigurationFacade()
    {
        
        //App::bind('AdminConfiguration', function () {
        //    return new AdminConfigurationManager();
        //});
        $this->app->alias('AdminConfiguration', 'Mage2\System\View\AdminConfiguration');
    }
    
    
     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['AdminConfiguration','AdminMenu','Theme','Payment','Shipping'];
    }
}
