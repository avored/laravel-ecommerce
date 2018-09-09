<?php

namespace AvoRed\Banner;

use Illuminate\Support\ServiceProvider;
use AvoRed\Banner\Widget\Banner\Widget;
use AvoRed\Framework\AdminMenu\AdminMenu;
use AvoRed\Framework\Widget\Facade as WidgetFacade;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;
use AvoRed\Banner\Models\Repository\BannerRepository;
use AvoRed\Banner\Models\Contracts\BannerInterface;
use AvoRed\Framework\Permission\Facade as PermissionFacade;
use AvoRed\Framework\Permission\PermissionGroup;

class Module extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerWidget();
        $this->registerAdminMenu();
        $this->registerBreadCrumb();
        $this->publishFiles();
        $this->registerModelContracts();
        $this->registerPermission();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-banner');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-banner');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $bannerProduct = new Widget();
        WidgetFacade::make($bannerProduct->identifier(), $bannerProduct);
    }

    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $cmsMenu = AdminMenuFacade::get('content');

        $bannerMenu = new AdminMenu();
        $bannerMenu->key('banner')
            ->label('Banner')
            ->route('admin.banner.index')
            ->icon('fas fa-ticket-alt');

        $cmsMenu->subMenu('banner', $bannerMenu);
    }

    /**
     * Register the Admin Breadcrumb.
     *
     * @return void
     */
    protected function registerBreadCrumb()
    {
        BreadcrumbFacade::make('admin.banner.index', function ($breadcrumb) {
            $breadcrumb->label('Banner')
                                    ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.banner.create', function ($breadcrumb) {
            $breadcrumb->label('Create')
                                    ->parent('admin.dashboard')
                                    ->parent('admin.banner.index');
        });

        BreadcrumbFacade::make('admin.banner.edit', function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.banner.index');
        });
    }

    /**
     * Publish Files for AvoRed Banner Modules.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ], 'avored-banner-views');
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);
    }

    /**
     * Register the Repository Instance.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        $this->app->bind(BannerInterface::class, BannerRepository::class);
    }

    /**
     * Register Permission for this Module
     *
     * @return void
     */
    public function registerPermission()
    {
        $permissionGroup = PermissionFacade::add('banner', function (PermissionGroup $group) {
            $group->label('Banner Permissions');
        });
        $permissionGroup->addPermission('admin-banner-list')
            ->label('Banner List')
            ->routes('admin.banner.index');
        $permissionGroup->addPermission('admin-banner-create')
            ->label('Create Banner')
            ->routes('admin.banner.create,admin.banner.store');
        $permissionGroup->addPermission('admin-banner-update')
            ->label('Update Banner')
            ->routes('admin.banner.edit,admin.banner.update');
        $permissionGroup->addPermission('admin-banner-destroy')
            ->label('Destroy Banner')
            ->routes('admin.banner.destroy');
    }
}
