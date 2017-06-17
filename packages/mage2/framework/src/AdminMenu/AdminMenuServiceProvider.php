<?php
namespace Mage2\Framework\AdminMenu;

use Illuminate\Support\ServiceProvider;

class AdminMenuServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAdminMenu();
        $this->app->alias('adminmenu', 'Mage2\Framework\AdminMenu\AdminMenuBuilder');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $this->app->singleton('adminmenu', function ($app) {
            return new AdminMenuBuilder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['adminmenu', 'Mage2\Framework\AdminMenu\AdminMenuBuilder'];
    }
}