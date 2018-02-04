<?php

namespace Mage2\Ecommerce\Permission;

use Illuminate\Support\Facades\Blade;
use Mage2\Ecommerce\Permission\Facade as PermissionFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Provider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->registerPermissions();

        Blade::directive('hasPermission', function ($routeName) {

            $condition = false;
            $user = Auth::guard('admin')->user();

            if (!$user) {
                $condition = $user->hasPermission($routeName) ?: false;
            }

            $converted_res = ($condition) ? 'true' : 'false';

            return "<?php if ($converted_res): ?>";

        });

        Blade::directive('endHasPermission', function () {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->app->singleton('permission', 'Mage2\Ecommerce\Permission\Manager');
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

        $permissionGroup = PermissionFacade::add('category')
            ->label('Category Permissions');


        $permissionGroup->addPermission('admin-category-list')
            ->label('Category List')
            ->routes('admin.category.index');

        $permissionGroup->addPermission('admin-category-create')
            ->label('Create Category')
            ->routes('admin.category.create,admin.category.store');

        $permissionGroup->addPermission('admin-category-update')
            ->label('Update Category')
            ->routes('admin.category.edit,admin.category.update');

        $permissionGroup->addPermission('admin-category-destroy')
            ->label('Destroy Category')
            ->routes('admin.category.destroy');




        $permissionGroup = PermissionFacade::add('product')
            ->label('Product Permissions');

        $permissionGroup->addPermission('admin-product-list')
            ->label('Product List')
            ->routes('admin.product.index');
        $permissionGroup->addPermission('admin-product-create')
            ->label('Create Product')
            ->routes('admin.product.create,admin.product.store');
        $permissionGroup->addPermission('admin-product-update')
            ->label('Update Product')
            ->routes('admin.product.edit,admin.product.update');
        $permissionGroup->addPermission('admin-product-destroy')
            ->label('Destroy Product')
            ->routes('admin.product.destroy');

        $permissionGroup = PermissionFacade::add('attribute')
            ->label('Attribute Permissions');

        $permissionGroup->addPermission('admin-attribute-list')
            ->label('Attribute List')
            ->routes('admin.attribute.index');
        $permissionGroup->addPermission('admin-attribute-create')
            ->label('Attribute')
            ->routes('admin.attribute.create,admin.attribute.store');
        $permissionGroup->addPermission('admin-attribute-update')
            ->label('Attribute')
            ->routes('admin.attribute.edit,admin.attribute.update');
        $permissionGroup->addPermission('admin-attribute-destroy')
            ->label('Attribute')
            ->routes('admin.attribute.destroy');


        $permissionGroup = PermissionFacade::add('property')
            ->label('Attribute Permissions');

        $permissionGroup->addPermission('admin-property-list')
            ->label('Property List')
            ->routes('admin.property.index');
        $permissionGroup->addPermission('admin-property-create')
            ->label('Property Create')
            ->routes('admin.property.create,admin.property.store');
        $permissionGroup->addPermission('admin-attribute-update')
            ->label('Property Update')
            ->routes('admin.property.edit,admin.property.update');
        $permissionGroup->addPermission('admin-property-destroy')
            ->label('Property Destroy')
            ->routes('admin.property.destroy');


        //
        $permissionGroup = PermissionFacade::add('subscriber')
            ->label('Subscriber Permissions');

        $permissionGroup->addPermission('admin-subscriber-list')
            ->label('Subscriber List')
            ->routes('admin.subscriber.index');

        $permissionGroup->addPermission('admin-subscriber-create')
            ->label('Subscriber Create')
            ->routes('admin.subscriber.create,admin.subscriber.store');

        $permissionGroup->addPermission('admin-subscriber-update')
            ->label('Subscriber Update')
            ->routes('admin.subscriber.edit,admin.subscriber.update');

        $permissionGroup->addPermission('admin-subscriber-destroy')
            ->label('Subscriber Destroy')
            ->routes('admin.subscriber.destroy');


        $permissionGroup = PermissionFacade::add('tax-rule')
            ->label('Tax Rule Permissions');

        $permissionGroup->addPermission('admin-tax-rule-list')
            ->label('Tax Rule List')
            ->routes('admin.tax-rule.index');

        $permissionGroup->addPermission('admin-tax-rule-create')
            ->label('Tax Rule Create')
            ->routes('admin.tax-rule.create,admin.tax-rule.store');

        $permissionGroup->addPermission('admin-tax-rule-update')
            ->label('Tax Rule Update')
            ->routes('admin.tax-rule.edit,admin.tax-rule.update');

        $permissionGroup->addPermission('admin-tax-rule-destroy')
            ->label('Tax Rule Destroy')
            ->routes('admin.tax-rule.destroy');



        $permissionGroup = PermissionFacade::add('admin-user')
            ->label('Admin User Permissions');

        $permissionGroup->addPermission('admin-admin-user-list')
            ->label('Admin User List')
            ->routes('admin.admin-user.index');

        $permissionGroup->addPermission('admin-admin-user-create')
            ->label('Admin User Create')
            ->routes('admin.admin-user.create,admin.admin-user.store');

        $permissionGroup->addPermission('admin-admin-user-update')
            ->label('Admin User Update')
            ->routes('admin.admin-user.edit,admin.admin-user.update');

        $permissionGroup->addPermission('admin-admin-user-destroy')
            ->label('Admin User Destroy')
            ->routes('admin.admin-user.destroy');


        $permissionGroup = PermissionFacade::add('role')
            ->label('Role Permissions');

        $permissionGroup->addPermission('admin-role-list')
            ->label('Role List')
            ->routes('admin.role.index');

        $permissionGroup->addPermission('admin-role-create')
            ->label('Role Create')
            ->routes('admin.role.create,admin.role.store');

        $permissionGroup->addPermission('admin-role-update')
            ->label('Role Update')
            ->routes('admin.role.edit,admin.role.update');

        $permissionGroup->addPermission('admin-role-destroy')
            ->label('Role Destroy')
            ->routes('admin.role.destroy');


        $permissionGroup = PermissionFacade::add('role')
            ->label('Theme Permissions');

        $permissionGroup->addPermission('admin-theme-list')
            ->label('Theme List')
            ->routes('admin.theme.index');

        $permissionGroup->addPermission('admin-theme-create')
            ->label('Theme Upload/Create')
            ->routes('admin.create.index','admin.theme.store');

        $permissionGroup->addPermission('admin-theme-activated')
            ->label('Theme Activated')
            ->routes('admin.activated.index');

        $permissionGroup->addPermission('admin-theme-deactivated')
            ->label('Theme Deactivated')
            ->routes('admin.deactivated.index');

        $permissionGroup->addPermission('admin-theme-destroy')
            ->label('Theme Destroy')
            ->routes('admin.destroy.index');


        $permissionGroup = PermissionFacade::add('configuration')
            ->label('Configuration Permissions');

        $permissionGroup->addPermission('admin-configuration')
            ->label('Configuration')
            ->routes('admin.configuration');


        $permissionGroup->addPermission('admin-configuration-store')
            ->label('Configuration Store')
            ->routes('admin.configuration.store');



        $permissionGroup = PermissionFacade::add('order')
            ->label('Order Permissions');

        $permissionGroup->addPermission('admin-order-list')
            ->label('Order List')
            ->routes('admin.order.index');


        $permissionGroup->addPermission('admin-order-view')
            ->label('Order View')
            ->routes('admin.order.view');

        $permissionGroup->addPermission('admin-order-send-invoice-email')
            ->label('Order Sent Invoice By Email')
            ->routes('admin.order.send-email-invoice');

        $permissionGroup->addPermission('admin-order-change-status')
            ->label('Order Change Status')
            ->routes('admin.order.change-status,admin.order.update-status');


        return $this;


    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permission', 'Mage2\Ecommerce\Permission\Manager'];
    }
}