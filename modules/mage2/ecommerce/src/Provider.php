<?php
namespace Mage2\Ecommerce;

use Illuminate\Support\ServiceProvider;

use Mage2\Ecommerce\Http\Middleware\AdminAuth;
use Mage2\Ecommerce\Http\Middleware\AdminApiAuth;
use Mage2\Ecommerce\Http\Middleware\ProductViewed;
use Mage2\Ecommerce\Http\Middleware\Visitor;
use Mage2\Ecommerce\Http\Middleware\RedirectIfAdminAuth;
use Mage2\Ecommerce\Http\Middleware\FrontAuth;
use Mage2\Ecommerce\Http\Middleware\RedirectIfFrontAuth;

use Mage2\Ecommerce\Http\ViewComposers\AdminNavComposer;
use Mage2\Ecommerce\Http\ViewComposers\CategoryFieldsComposer;
use Mage2\Ecommerce\Http\ViewComposers\LayoutAppComposer;
use Mage2\Ecommerce\Http\ViewComposers\ProductFieldsComposer;
use Mage2\Ecommerce\Http\ViewComposers\CheckoutComposer;
use Mage2\Ecommerce\Http\ViewComposers\MyAccountSidebarComposer;

use Laravel\Passport\Passport;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\KeysCommand;
use Carbon\Carbon;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Mage2\Ecommerce\Http\ViewComposers\ProductSpecificationComposer;
use Mage2\Ecommerce\Http\ViewComposers\RelatedProductViewComposer;
use Illuminate\Support\Facades\Storage;


class Provider extends ServiceProvider
{

    protected $providers = [
        \Mage2\Ecommerce\AdminMenu\Provider::class,
        \Mage2\Ecommerce\DataGrid\Provider::class,
        \Mage2\Ecommerce\Image\Provider::class,
        \Mage2\Ecommerce\Attribute\Provider::class,
        \Mage2\Ecommerce\Tabs\Provider::class,
        \Mage2\Ecommerce\Modules\Provider::class,
        \Mage2\Ecommerce\Payment\Provider::class,
        \Mage2\Ecommerce\Shipping\Provider::class,
        \Mage2\Ecommerce\Configuration\Provider::class,
        \Mage2\Ecommerce\Permission\Provider::class,
        \Mage2\Ecommerce\Theme\Provider::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware();
        $this->registerResources();
        $this->registerViewComposerData();
        $this->registerPassportResources();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        Passport::ignoreMigrations();

    }


    /**
     * Registering Mage2 E commerce Resource
     * e.g. Route, View, Database path & Translation
     *
     * @return void
     */
    protected function registerResources()
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'mage2-ecommerce');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mage2-ecommerce');
    }

    /**
     * Registering Mage2 E commerce Middleware
     *
     * @return void
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('admin.api.auth', AdminApiAuth::class);
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        $router->aliasMiddleware('front.auth', FrontAuth::class);
        $router->aliasMiddleware('front.guest', RedirectIfFrontAuth::class);
        $router->aliasMiddleware('visitor', Visitor::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
        $router->aliasMiddleware('product.viewed', ProductViewed::class);
    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('mage2-ecommerce::admin.layouts.left-nav', AdminNavComposer::class);
        View::composer(['mage2-ecommerce::admin.category._fields'], CategoryFieldsComposer::class);
        View::composer('checkout.index', CheckoutComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('layouts.app', LayoutAppComposer::class);
        View::composer('catalog.product.view', RelatedProductViewComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('mage2-framework::product.edit', ProductFieldComposer::class);
        View::composer('catalog.product.view', ProductSpecificationComposer::class);
        View::composer(['mage2-ecommerce::admin.product.create',
            'mage2-ecommerce::admin.product.edit'],
            ProductFieldsComposer::class);
        View::composer(['mage2-framework::product.create',
            'mage2-framework::product.edit'],
            RelatedProductComposer::class);
    }

    /**
     * Registering Mage2 E commerce Services
     * e.g Admin Menu
     *
     * @return void
     */
    protected function registerProviders()
    {
        if (!Storage::disk('local')->has('installed.txt')) {
            App::register(\Mage2\Install\Module::class);
        }

        foreach ($this->providers as $provider) {
            App::register($provider);
        }
    }


    /*
   *  Registering Passport Oauth2.0 client
   *      *
   * @return void
   */
    public function registerPassportResources()
    {
        Passport::ignoreMigrations();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
    }

}