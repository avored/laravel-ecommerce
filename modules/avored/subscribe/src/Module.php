<?php

namespace AvoRed\Subscribe;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\AdminMenu;
use AvoRed\Framework\Permission\Facade as PermissionFacade;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;
use AvoRed\Framework\Breadcrumb\Facade  as BreadcrumbFacade;
use AvoRed\Subscribe\Models\Contracts\SubscribeInterface;
use AvoRed\Subscribe\Models\Repository\SubscribeRepository;

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
        $this->registerAdminMenu();
        $this->registerPermission();
        $this->registerBreadcrumb();
        $this->registerModelContracts();
        $this->publishFiles();
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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-subscribe');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-subscribe');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $systemMenu = AdminMenuFacade::get('user');

        $systemMenu->subMenu('subscribe', function (AdminMenu $menu) {
            $menu->key('subscribe')
                ->label('Subscribe')
                ->route('admin.subscribe.index')
                ->icon('fas fa-users');
        });
    }

    /**
     * Register the Breadcrumbs.
     *
     * @return void
     */
    protected function registerBreadcrumb()
    {
        BreadcrumbFacade::make('admin.subscribe.index', function ($breadcrumb) {
            $breadcrumb->label('Subscribe')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.subscribe.create', function ($breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.subscribe.index');
        });

        BreadcrumbFacade::make('admin.subscribe.edit', function ($breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.subscribe.index');
        });
    }

    public function registerPermission()
    {
        //
        $permissionGroup = PermissionFacade::add('subscribe')
            ->label('Subscriber Permissions');

        $permissionGroup->addPermission('admin-subscribe-list')
            ->label('Subscriber List')
            ->routes('admin.subscribe.index');

        $permissionGroup->addPermission('admin-subscribe-create')
            ->label('Subscriber Create')
            ->routes('admin.subscribe.create,admin.subscribe.store');

        $permissionGroup->addPermission('admin-subscribe-update')
            ->label('Subscriber Update')
            ->routes('admin.subscribe.edit,admin.subscribe.update');

        $permissionGroup->addPermission('admin-subscribe-destroy')
            ->label('Subscriber Destroy')
            ->routes('admin.subscribe.destroy');
    }

    /**
     * Publish files paths for this avo red module.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ], 'avored-module-views');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('avored-migrations'),
        ]);
    }

    /**
     * Register the Repository Instance.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        $this->app->bind(SubscribeInterface::class, SubscribeRepository::class);
    }
}
