<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce;

use Illuminate\Support\ServiceProvider;
use Mage2\Ecommerce\Http\Middleware\AdminAuth;
use Mage2\Ecommerce\Http\Middleware\AdminApiAuth;
use Mage2\Ecommerce\Http\Middleware\Visitor;
use Mage2\Ecommerce\Http\Middleware\RedirectIfAdminAuth;
use Illuminate\Support\Facades\View;
use Mage2\Ecommerce\Http\Middleware\FrontAuth;
use Mage2\Ecommerce\Http\Middleware\RedirectIfFrontAuth;
use Mage2\Ecommerce\Http\ViewComposers\AdminNavComposer;
use Illuminate\Support\Facades\App;
use Mage2\Ecommerce\Http\ViewComposers\CategoryFieldsComposer;
use Mage2\Ecommerce\Http\ViewComposers\LayoutAppComposer;
use Mage2\Ecommerce\Http\ViewComposers\ProductFieldsComposer;
use Mage2\Ecommerce\Http\ViewComposers\CheckoutComposer;
use Mage2\Ecommerce\Http\ViewComposers\MyAccountSidebarComposer;
use Mage2\Ecommerce\Configuration\Facade as AdminConfiguration;

class Provider extends ServiceProvider
{


    protected $providers = [
        'Mage2\Ecommerce\AdminMenu\Provider',
        'Mage2\Ecommerce\DataGrid\Provider',
        'Mage2\Ecommerce\Image\Provider',
        'Mage2\Ecommerce\Attribute\Provider',
        'Mage2\Ecommerce\Tabs\Provider',
        'Mage2\Ecommerce\Payment\Provider',
        'Mage2\Ecommerce\Configuration\Provider',
        \Mage2\Ecommerce\Permission\Provider::class
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
        $this->registerAdminConfiguration();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

    }


    /**
     * Registering Mage2 E commerce Resource
     * e.g. Route, View, Database path & Translation
     *
     * @return void
     */
    protected function registerResources() {

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //Route::middleware(['web'])->group();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mage2-ecommerce');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mage2-ecommerce');
    }

    /**
     * Registering Mage2 E commerce Middleware
     *
     * @return void
     */
    protected function registerMiddleware() {
        $router = $this->app['router'];


        $router->aliasMiddleware('admin.api.auth', AdminApiAuth::class);
        $router->aliasMiddleware('admin.auth', AdminAuth::class);
        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
        $router->aliasMiddleware('front.auth', FrontAuth::class);
        $router->aliasMiddleware('front.guest', RedirectIfFrontAuth::class);
        $router->aliasMiddleware('visitor', Visitor::class);
    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('mage2-ecommerce::admin.layouts.left-nav',AdminNavComposer::class);
        View::composer(['mage2-ecommerce::admin.category._fields'], CategoryFieldsComposer::class);
        View::composer(['mage2-ecommerce::admin.product.create',
                        'mage2-ecommerce::admin.product.edit'], ProductFieldsComposer::class);

        //View::composer('*',LayoutAppComposer::class);
        View::composer('checkout.index',CheckoutComposer::class);
        View::composer('user.my-account.sidebar', MyAccountSidebarComposer::class);

        View::composer('layouts.app', LayoutAppComposer::class);
    }

    /**
     * Registering Mage2 E commerce Services
     * e.g Admin Menu
     *
     * @return void
     */
    protected function registerProviders() {

        foreach($this->providers as $provider) {
            App::register($provider);
        }
    }

    /**
     * Register Admin Configuration for the Address Modules
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title' => 'Address Configuration',
            'description' => 'Set Default Country for Store',
            'edit_action' => 'admin.configuration.address',
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

}
