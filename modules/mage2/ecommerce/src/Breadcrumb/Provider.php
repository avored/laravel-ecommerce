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


        //Breadcrumb::make('admin-admin-user',function ($breadcrumb) {
        //    $breadcrumb->label('Admin User')
        //                ->parent('admin-dashboard');
        //});


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