<?php
namespace AvoRed\Review;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\AdminMenu\AdminMenu;
use AvoRed\Review\Http\ViewComposers\ProductReviewComposer;
use Illuminate\Support\Facades\View;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;
use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;
use AvoRed\Review\Models\Contracts\ProductReviewInterface;
use AvoRed\Review\Models\Repository\ProductReviewRepository;
use AvoRed\Framework\Permission\PermissionGroup;
use AvoRed\Framework\Permission\Facade as PermissionFacade;

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
        $this->registerBreadCrumb();
        $this->registerViewComposer();
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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-review');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-review');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }



    /**
     * Register the Product Edit View Composer Class.
     *
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('avored-review::product.review', ProductReviewComposer::class);
    }


    /**
     * Register the Admin Menu.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $shopMenu = AdminMenuFacade::get('shop');
        $shopMenu->subMenu('review', function(AdminMenu $menu) {
            
            $menu->key('review')
                ->label('Review')
                ->route('admin.review.index')
                ->icon('fas fa-bullhorn');
        });
    }

    /**
     * Register the Admin Breadcrumb.
     *
     * @return void
     */
    protected function registerBreadCrumb()
    {
        BreadcrumbFacade::make('admin.review.index', function ($breadcrumbs) {
            $breadcrumbs->label('Review')
                ->parent('admin.dashboard');
        });
    }

    /**
     * Publish files paths for this avo red module.
     *
     * @return void
     */
    public function publishFiles() {

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ],'avored-module-views');

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
        $this->app->bind(ProductReviewInterface::class, ProductReviewRepository::class);
    }


    /**
     * Register Permission for this Module
     * 
     * @return void
     */
    public function registerPermission() 
    {
        $permissionGroup = PermissionFacade::add('review', function(PermissionGroup $group){
            $group->label('Review Permissions');
        });
        $permissionGroup->addPermission('admin-review-list')
            ->label('Review List')
            ->routes('admin.review.index');
        $permissionGroup->addPermission('admin-review-approved')
            ->label('Review Approved')
            ->routes('review.approve');
        
   
    }

}