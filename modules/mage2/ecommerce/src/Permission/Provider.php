<?php
namespace Mage2\Ecommerce\Permission;

use Mage2\Ecommerce\Permission\Facade as PermissionFacade;
use Illuminate\Support\ServiceProvider;

class Provider extends  ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        //$this->registerPermissions();
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->alias('permission', 'Mage2\Ecommerce\Permission\Manager');
    }

    /**
     * Register the permission Manager Instance.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('permission', function () {
            new Manager();
        });
    }

    /**
     * Register the permissions
     *
     * @return void
     */
    protected function registerPermissions()
    {

        $permissions = [
            ['title' => 'Theme List', 'routes' => 'admin.theme.index'],
            ['title' => 'Theme Upload', 'routes' => "admin.theme.create,admin.theme.store"],
            ['title' => 'Theme Activate', 'routes' => "admin.theme.activate"],
            ['title' => 'Theme Destroy', 'routes' => "admin.theme.destroy"],
        ];

        foreach ($permissions as $permission) {
            //PermissionFacade::add($permission);
        }

        $permissionGroup = PermissionFacade::get('gift-coupon');

        $permissionGroup->put('title', 'Gift Coupon Permissions');

        $permissions = Collection::make([
            ['title' => 'Gift Coupon List', 'routes' => 'admin.gift-coupon.index'],
            ['title' => 'Gift Coupon Create', 'routes' => "admin.gift-coupon.create,admin.gift-coupon.store"],
            ['title' => 'Gift Coupon  Edit', 'routes' => "admin.gift-coupon.edit,admin.gift-coupon.update"],
            ['title' => 'Gift Coupon  Destroy', 'routes' => "admin.gift-coupon.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        PermissionFacade::set('gift-coupon',$permissionGroup);

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'permission',  'Mage2\Ecommerce\Permission\Manager'];
    }
}