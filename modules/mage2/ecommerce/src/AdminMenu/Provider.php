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
namespace Mage2\Ecommerce\AdminMenu;

use Mage2\Ecommerce\AdminMenu\Facade as AdminMenuFacade;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        $this->registerMenu();
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerServices();
        $this->app->alias('adminmenu', 'Mage2\Ecommerce\AdminMenu\Builder');


    }
    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('adminmenu', function ($app) {
            return new Builder();
        });
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerMenu() {

        AdminMenuFacade::add('catalog')
                        ->label('Catalog')
                        ->route('#');

        $productMenu = new AdminMenu();
        $productMenu->key('product')
                ->label('Product')
                ->route('admin.product.index');

        $categoryMenu = new AdminMenu();
        $categoryMenu->key('category')
            ->label('Category')
            ->route('admin.category.index');

        $catalogMenu = AdminMenuFacade::get('catalog');

        $catalogMenu->subMenu('product', $productMenu);
        $catalogMenu->subMenu('category', $categoryMenu);


        AdminMenuFacade::add('system')
            ->label('System')
            ->route('#');

        $menu = new AdminMenu();
        $menu ->key('configuration')
            ->label('Configuration')
            ->route('admin.configuration');

        $systemMenu = AdminMenuFacade::get('system');
        $systemMenu->subMenu('configuration', $menu );


        AdminMenuFacade::add('order')
            ->label('Order')
            ->route('#');

        $menu = new AdminMenu();
        $menu ->key('gift-coupon')
            ->label('Gift Coupon')
            ->route('admin.gift-coupon.index');

        $systemMenu = AdminMenuFacade::get('order');
        $systemMenu->subMenu('gift-coupon', $menu );



    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adminmenu', 'Mage2\Ecommerce\AdminMenu\Builder'];
    }
}