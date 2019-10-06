<?php

namespace AvoRed\Review;

use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Tab\TabItem;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;
use AvoRed\Review\Database\Repository\ProductReviewRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use AvoRed\Review\Http\ViewComposers\ProductReviewComposer;

class Module extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerTab();
        $this->registerViewComposer();
        // $this->publishFiles();
        //$this->registerListener();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductReviewModelInterface::class, ProductReviewRepository::class);
    }

    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'a-review');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'a-review');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Product Edit View Composer Class.
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('a-review::admin.review.tab', ProductReviewComposer::class);
    }

    /**
     * Register the Product Edit View Composer Class.
     * @return void
     */
    protected function registerTab()
    {
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.review')
                ->label('a-review::review.product-tab')
                ->view('a-review::admin.review.tab');
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
    public function publishFiles()
    {
        $this->publishes(
            [ __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')],
            'avored-module-views'
        );
        $this->publishes(
            [ __DIR__ . '/../dist/js/front' => base_path('public/js')],
            'avored-front-js'
        );
        $this->publishes(
            [ __DIR__ . '/../dist/js/admin' => base_path('public/avored-admin/js')],
            'avored-admin-js'
        );

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('avored-migrations'),
        ]);
    }
}
