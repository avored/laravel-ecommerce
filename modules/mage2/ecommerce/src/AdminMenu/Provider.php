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
        $catalogMenu = AdminMenuFacade::get('catalog');

        $productMenu = new AdminMenu();
        $productMenu->key('product')
                ->label('Product')
                ->route('admin.product.index');
        $catalogMenu->subMenu('product', $productMenu);


        $categoryMenu = new AdminMenu();
        $categoryMenu->key('category')
            ->label('Category')
            ->route('admin.category.index');
        $catalogMenu->subMenu('category', $categoryMenu);

        $attributeMenu = new AdminMenu();
        $attributeMenu->key('attribute')
            ->label('Attributes')
            ->route('admin.attribute.index');
        //$catalogMenu->subMenu('attribute',$attributeMenu);


        $pageMenu = new AdminMenu();
        $pageMenu->key('page')
            ->label('Page')
            ->route('admin.page.index');
        //$catalogMenu->subMenu('page', $pageMenu);

        $reviewMenu = new AdminMenu();
        $reviewMenu->key('review')
            ->label('Review')
            ->route('admin.review.index');
        //$catalogMenu->subMenu('review', $reviewMenu);

        AdminMenuFacade::add('sale')
            ->label('Sales')
            ->route('#');
        $saleMenu = AdminMenuFacade::get('sale');

        AdminMenuFacade::add('system')
            ->label('System')
            ->route('#');

        $systemMenu = AdminMenuFacade::get('system');


        $configurationMenu = new AdminMenu();
        $configurationMenu->key('configuration')
            ->label('Configuration')
            ->route('admin.configuration');
        //$systemMenu->subMenu('configuration', $configurationMenu );

        $orderMenu = new AdminMenu();
        $orderMenu->key('order')
            ->label('Orders')
            ->route('admin.order.index');
        $saleMenu->subMenu('order', $orderMenu);


        $giftCouponMenu = new AdminMenu();
        $giftCouponMenu->key('gift-coupon')
            ->label('Gift Coupon')
            ->route('admin.gift-coupon.index');
        //$saleMenu->subMenu('gift-coupon', $giftCouponMenu );


        $orderStatusMenu = new AdminMenu();
        $orderStatusMenu->key('order-status')
            ->label('Order Status')
            ->route('admin.order-status.index');
        //$saleMenu->subMenu('order-status', $orderStatusMenu );

        $adminUserMenu = new AdminMenu();
        $adminUserMenu->key('admin-user')
            ->label('Admin User')
            ->route('admin.admin-user.index');
        $systemMenu->subMenu('admin-user',$adminUserMenu);


        $roleMenu = new AdminMenu();
        $roleMenu->key('roles')
            ->label('Admin User Roles')
            ->route('admin.role.index');
        //$systemMenu->subMenu('roles',$roleMenu);

        $taxGroupMenu = new AdminMenu();
        $taxGroupMenu->key('tax-group')
            ->label('Tax Group')
            ->route('admin.tax-group.index');
        //$saleMenu->subMenu('tax-group',$taxGroupMenu);

        $taxRuleMenu = new AdminMenu();
        $taxRuleMenu->key('tax-rule')
            ->label('Tax Rule')
            ->route('admin.tax-rule.index');
        //$saleMenu->subMenu('tax-rule',$taxRuleMenu);

        $contryMenu = new AdminMenu();
        $contryMenu->key('countries')
            ->label('Countries')
            ->route('admin.country.index');
        //$saleMenu->subMenu('countries',$contryMenu);

        $stateMenu = new AdminMenu();
        $stateMenu->key('state')
            ->label('States')
            ->route('admin.state.index');
        //$saleMenu->subMenu('state',$stateMenu);



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