<?php
namespace Mage2\Framework\Auth;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Auth\Access\PermissionManager;

class AuthServiceProvider extends ServiceProvider
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
        $this->registerPermission();
        $this->app->alias('permission', 'Mage2\Framework\Auth\Access\PermissionManager');
    }

    /**
     * Register the permission instance.
     *
     * @return void
     */
    protected function registerPermission()
    {
        $this->app->singleton('permission', function ($app) {
            new PermissionManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permission', 'Mage2\Framework\Auth\Access\PermissionManager'];
    }
}