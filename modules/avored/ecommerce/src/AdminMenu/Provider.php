<?php
namespace AvoRed\Ecommerce\AdminMenu;

use AvoRed\Ecommerce\AdminMenu\Facade as AdminMenuFacade;
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
        $this->app->alias('adminmenu', 'AvoRed\Ecommerce\AdminMenu\Builder');


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
                        ->route('#')
                        ->icon('fa fa-book');
        $catalogMenu = AdminMenuFacade::get('catalog');

        $productMenu = new AdminMenu();
        $productMenu->key('product')
                ->label('Product')
                ->route('admin.product.index')
                ->icon('fab fa-dropbox');
        $catalogMenu->subMenu('product', $productMenu);


        $categoryMenu = new AdminMenu();
        $categoryMenu->key('category')
            ->label('Category')
            ->route('admin.category.index')
            ->icon('far fa-building');
        $catalogMenu->subMenu('category', $categoryMenu);

        $attributeMenu = new AdminMenu();
        $attributeMenu->key('attribute')
            ->label('Attribute')
            ->route('admin.attribute.index')
            ->icon('fas fa-file-alt');
        $catalogMenu->subMenu('attribute',$attributeMenu);

        $propertyMenu = new AdminMenu();
        $propertyMenu->key('property')
            ->label('Property')
            ->route('admin.property.index')
            ->icon('fas fa-file-powerpoint');
        $catalogMenu->subMenu('property',$propertyMenu);



        AdminMenuFacade::add('promotion')
            ->label('Promotion')
            ->route('#')
            ->icon('fas fa-bullhorn');
        $promotionMenu = AdminMenuFacade::get('promotion');

        $subscriberMenu = new AdminMenu();
        $subscriberMenu->key('subscriber')
            ->label('Subscriber')
            ->route('admin.subscriber.index')
            ->icon('fas fa-users');
        $promotionMenu->subMenu('subscriber',$subscriberMenu);


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
            ->route('#')
            ->icon('fas fa-chart-line');
        $saleMenu = AdminMenuFacade::get('sale');

        AdminMenuFacade::add('system')
            ->label('System')
            ->route('#')
            ->icon('fas fa-cogs');

        $systemMenu = AdminMenuFacade::get('system');


        $configurationMenu = new AdminMenu();
        $configurationMenu->key('configuration')
            ->label('Configuration')
            ->route('admin.configuration')
            ->icon('fas fa-cog');
        $systemMenu->subMenu('configuration', $configurationMenu );

        $orderMenu = new AdminMenu();
        $orderMenu->key('order')
            ->label('Order')
            ->route('admin.order.index')
            ->icon('fas fa-dollar-sign');
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
            ->route('admin.admin-user.index')
            ->icon('fas fa-user');
        $systemMenu->subMenu('admin-user',$adminUserMenu);


        $themeMenu = new AdminMenu();
        $themeMenu->key('themes')
            ->label('Themes ')
            ->route('admin.theme.index')
            ->icon('fas fa-adjust');
        $systemMenu->subMenu('themes',$themeMenu);




        $roleMenu = new AdminMenu();
        $roleMenu->key('roles')
            ->label('Role')
            ->route('admin.role.index')
            ->icon('fab fa-periscope');
        $systemMenu->subMenu('roles',$roleMenu);

        $taxGroupMenu = new AdminMenu();
        $taxGroupMenu->key('tax-group')
            ->label('Tax Group')
            ->route('admin.tax-group.index');
        //$saleMenu->subMenu('tax-group',$taxGroupMenu);

        $taxRuleMenu = new AdminMenu();
        $taxRuleMenu->key('tax-rule')
            ->label('Tax Rule')
            ->route('admin.tax-rule.index')
            ->icon('far fa-folder');
        $saleMenu->subMenu('tax-rule',$taxRuleMenu);

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
        return ['adminmenu', 'AvoRed\Ecommerce\AdminMenu\Builder'];
    }
}