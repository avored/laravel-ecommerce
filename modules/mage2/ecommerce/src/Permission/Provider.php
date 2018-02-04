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