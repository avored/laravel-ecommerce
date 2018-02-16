<?php
namespace Mage2\Ecommerce\Breadcrumb;

use Mage2\Ecommerce\Breadcrumb\Facade as BreadcrumbFacade;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        $this->registerBreadcrumb();
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerServices();
        $this->app->alias('breadcrumb', 'Mage2\Ecommerce\Breadcrumb\Builder');


    }
    /**
     * Register the Admin Menu instance.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton('breadcrumb', function ($app) {
            return new Builder();
        });
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerBreadcrumb() {

        BreadcrumbFacade::make('admin.dashboard',function ($breadcrumb) {
            $breadcrumb->label('Dashboard');
        });

        BreadcrumbFacade::make('admin.product.index',function ($breadcrumb) {
            $breadcrumb->label('Product')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.product.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.product.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.attribute.index',function ($breadcrumb) {
            $breadcrumb->label('Attribute')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.attribute.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });


        BreadcrumbFacade::make('admin.property.index',function ($breadcrumb) {
            $breadcrumb->label('Property')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.property.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.property.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });



        BreadcrumbFacade::make('admin.subscriber.index',function ($breadcrumb) {
            $breadcrumb->label('Subscriber')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.subscriber.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.subscriber.index');
        });

        BreadcrumbFacade::make('admin.subscriber.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.subscriber.index');
        });



        BreadcrumbFacade::make('admin.order.index',function ($breadcrumb) {
            $breadcrumb->label('Order')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.order.view',function ($breadcrumb) {
            $breadcrumb->label('View')
                ->parent('admin.dashboard')
                ->parent('admin.order.index');;
        });

        BreadcrumbFacade::make('admin.theme.index',function ($breadcrumb) {
            $breadcrumb->label('Theme')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.theme.create',function ($breadcrumb) {
            $breadcrumb->label('Upload')
                ->parent('admin.dashboard')
                ->parent('admin.theme.index');
        });


        BreadcrumbFacade::make('admin.role.index',function ($breadcrumb) {
            $breadcrumb->label('Role')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.role.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });

        BreadcrumbFacade::make('admin.role.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });


        BreadcrumbFacade::make('admin.admin-user.index',function ($breadcrumb) {
            $breadcrumb->label('Admin User')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.admin-user.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.show',function ($breadcrumb) {
            $breadcrumb->label('Show')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });



        BreadcrumbFacade::make('admin.tax-rule.index',function ($breadcrumb) {
            $breadcrumb->label('Tax Rule')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.tax-rule.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.tax-rule.index');
        });

        BreadcrumbFacade::make('admin.tax-rule.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.tax-rule.index');
        });

        BreadcrumbFacade::make('admin.configuration',function ($breadcrumb) {
            $breadcrumb->label('Configuration')
                ->parent('admin.dashboard');
        });


        BreadcrumbFacade::make('admin.category.index',function ($breadcrumb) {
            $breadcrumb->label('Category')
                    ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.category.create',function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });

        BreadcrumbFacade::make('admin.category.edit',function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['breadcrumb', 'Mage2\Ecommerce\Breadcrumb\Builder'];
    }
}