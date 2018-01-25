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



        $permissionKey = 'order-status';
        $permissionGroup = Permission::get($permissionKey);

        $permissionGroup->put('title', 'Order Status Permissions');

        $permissions = Collection::make([
            ['title' => 'Order Status List', 'routes' => 'admin.order-status.index'],
            ['title' => 'Order Status Create', 'routes' => "admin.order-status.create,admin.order-status.store"],
            ['title' => 'Order Status Update', 'routes' => "admin.order-status.edit,admin.order-status.update"],
            ['title' => 'Order Status Destroy', 'routes' => "admin.order-status.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set($permissionKey,$permissionGroup);

        $permissionKey = 'page';
        $permissionGroup = Permission::get($permissionKey);

        $permissionGroup->put('title', 'Page Permissions');

        $permissions = Collection::make([
            ['title' => 'Page List', 'routes' => 'admin.page.index'],
            ['title' => 'Page Create', 'routes' => "admin.page.create,admin.page.store"],
            ['title' => 'Page Edit', 'routes' => "admin.page.edit,admin.page.update"],
            ['title' => 'Page Destroy', 'routes' => "admin.page.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set($permissionKey,$permissionGroup);

        $permissionGroup = Permission::get('user-role');

        $permissionGroup->put('title', 'User Role Permissions');

        $permissions = Collection::make([
            ['title' => 'User Role List', 'routes' => 'admin.role.index'],
            ['title' => 'User Role Create', 'routes' => "admin.role.create,admin.role.store"],
            ['title' => 'User Role Edit', 'routes' => "admin.role.edit,admin.role.update"],
            ['title' => 'User Role Destroy', 'routes' => "admin.role.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set('user-role',$permissionGroup);


        $permissionGroup = Permission::get('tax-rule');

        $permissionGroup->put('title', 'Tax Rule Permissions');

        $permissions = Collection::make([
            ['title' => 'Tax Rule List', 'routes' => 'admin.tax-rule.index'],
            ['title' => 'Tax Rule Create', 'routes' => "admin.tax-rule.create,admin.tax-rule.store"],
            ['title' => 'Tax Rule  Edit', 'routes' => "admin.tax-rule.edit,admin.tax-rule.update"],
            ['title' => 'Tax Rule  Destroy', 'routes' => "admin.tax-rule.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);
        Permission::set('tax-rule',$permissionGroup);


        /** Country Permission Start */
        $permissionGroup = Permission::get('country');

        $permissionGroup->put('title', 'Country Permissions');

        $permissions = Collection::make([
            ['title' => 'Country List', 'routes' => 'admin.country.index'],
            ['title' => 'Country Create', 'routes' => "admin.country.create,admin.country.store"],
            ['title' => 'Country  Edit', 'routes' => "admin.country.edit,admin.country.update"],
            ['title' => 'Country  Destroy', 'routes' => "admin.country.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set('country',$permissionGroup);


        /** State Permission Group */
        $permissionGroup = Permission::get('state');
        $permissionGroup->put('title', 'State Permissions');

        $permissions = Collection::make([
            ['title' => 'State List', 'routes' => 'admin.state.index'],
            ['title' => 'State Create', 'routes' => "admin.state.create,admin.state.store"],
            ['title' => 'State  Edit', 'routes' => "admin.state.edit,admin.state.update"],
            ['title' => 'State  Destroy', 'routes' => "admin.state.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set('state',$permissionGroup);


        $permissionGroup = Permission::get('user');

        $permissionGroup->put('title', 'User Permissions');

        $permissions = Collection::make([
            ['title' => 'Admin User List', 'routes' => 'admin.admin-user.index'],
            ['title' => 'Admin User Create', 'routes' => "admin.admin-user.create,admin.admin-user.store"],
            ['title' => 'Admin User  Edit', 'routes' => "admin.admin-user.edit,admin.admin-user.update"],
            ['title' => 'Admin User  Destroy', 'routes' => "admin.admin-user.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set('user', $permissionGroup);

        $permissionGroup = Permission::get('attribute');

        $permissionGroup->put('title', 'Attribute Permissions');

        $permissions = Collection::make([
            ['title' => 'Attribute List', 'routes' => 'admin.attribute.index'],
            ['title' => 'Attribute Create', 'routes' => "admin.attribute.create,admin.attribute.store"],
            ['title' => 'Attribute Edit', 'routes' => "admin.attribute.edit,admin.attribute.update"],
            ['title' => 'Attribute Destroy', 'routes' => "admin.attribute.destroy"],
        ]);

        $permissionGroup->put('routes', $permissions);

        Permission::set('attribute',$permissionGroup);

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