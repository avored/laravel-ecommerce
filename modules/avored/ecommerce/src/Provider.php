<?php
namespace AvoRed\Ecommerce;

use Illuminate\Support\ServiceProvider;

use AvoRed\Ecommerce\Http\Middleware\AdminAuth;
use AvoRed\Ecommerce\Http\Middleware\AdminApiAuth;
use AvoRed\Ecommerce\Http\Middleware\ProductViewed;
use AvoRed\Ecommerce\Http\Middleware\Visitor;
use AvoRed\Ecommerce\Http\Middleware\RedirectIfAdminAuth;
use AvoRed\Ecommerce\Http\Middleware\FrontAuth;
use AvoRed\Ecommerce\Http\Middleware\Permission;
use AvoRed\Ecommerce\Http\Middleware\RedirectIfFrontAuth;

use AvoRed\Ecommerce\Http\ViewComposers\AdminNavComposer;
use AvoRed\Ecommerce\Http\ViewComposers\CategoryFieldsComposer;
use AvoRed\Ecommerce\Http\ViewComposers\LayoutAppComposer;
use AvoRed\Ecommerce\Http\ViewComposers\ProductFieldsComposer;
use AvoRed\Ecommerce\Http\ViewComposers\CheckoutComposer;
use AvoRed\Ecommerce\Http\ViewComposers\MyAccountSidebarComposer;

use Laravel\Passport\Passport;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\KeysCommand;
use Carbon\Carbon;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use AvoRed\Ecommerce\Http\ViewComposers\ProductSpecificationComposer;
use AvoRed\Ecommerce\Http\ViewComposers\RelatedProductViewComposer;
use Illuminate\Support\Facades\Storage;
use AvoRed\Ecommerce\Widget\TotalUser\Widget as TotalUserWidget;
use AvoRed\Ecommerce\Widget\TotalOrder\Widget as TotalOrderWidget;
use AvoRed\Framework\Widget\Facade as WidgetFacade;


class Provider extends ServiceProvider
{

    protected $providers = [
        \AvoRed\Ecommerce\AdminMenu\Provider::class,
        \AvoRed\Ecommerce\Breadcrumb\Provider::class,
        \AvoRed\Ecommerce\DataGrid\Provider::class,
        \AvoRed\Ecommerce\Image\Provider::class,
        \AvoRed\Ecommerce\Attribute\Provider::class,
        \AvoRed\Ecommerce\Tabs\Provider::class,
        \AvoRed\Ecommerce\Modules\Provider::class,
        \AvoRed\Ecommerce\Payment\Provider::class,
        \AvoRed\Ecommerce\Shipping\Provider::class,
        \AvoRed\Ecommerce\Configuration\Provider::class,
        \AvoRed\Ecommerce\Permission\Provider::class,
        //\AvoRed\Ecommerce\Theme\Provider::class,
        //\AvoRed\Ecommerce\Widget\Provider::class
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
        $this->registerWidget();
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
     * Registering AvoRed E commerce Resource
     * e.g. Route, View, Database path & Translation
     *
     * @return void
     */
    protected function registerResources()
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-ecommerce');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-ecommerce');
    }

    /**
     * Registering AvoRed E commerce Middleware
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
        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('product.viewed', ProductViewed::class);
    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('avored-ecommerce::admin.layouts.left-nav', AdminNavComposer::class);
        View::composer(['avored-ecommerce::admin.category._fields'], CategoryFieldsComposer::class);
        View::composer('checkout.index', CheckoutComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('layouts.app', LayoutAppComposer::class);
        View::composer('catalog.product.view', RelatedProductViewComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);
        View::composer('avored-framework::product.edit', ProductFieldComposer::class);
        View::composer('catalog.product.view', ProductSpecificationComposer::class);
        View::composer(['avored-ecommerce::admin.product.create',
                        'avored-ecommerce::admin.product.edit'
                        ],  ProductFieldsComposer::class);

        View::composer(['avored-framework::product.create',
                        'avored-framework::product.edit'
                        ], RelatedProductComposer::class);
    }

    /**
     * Registering AvoRed E commerce Services
     * e.g Admin Menu
     *
     * @return void
     */
    protected function registerProviders()
    {
        if (!Storage::disk('local')->has('installed.txt')) {
            App::register(\AvoRed\Install\Module::class);
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


    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {

        $totalUserWidget = new TotalUserWidget();
        WidgetFacade::make($totalUserWidget->identifier(), $totalUserWidget);

        $totalOrderWidget = new TotalOrderWidget();
        WidgetFacade::make($totalOrderWidget->identifier(), $totalOrderWidget);

    }
}