<?php

namespace AvoRed\Review;

use AvoRed\Assets\AssetItem;
use AvoRed\Assets\Support\Facades\Asset;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;
use AvoRed\Review\Database\Repository\ProductReviewRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use AvoRed\Review\Http\ViewComposers\ProductReviewComposer;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Tab\TabItem;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductReviewModelInterface::class, ProductReviewRepository::class);
        $this->registerAssets();
    }


    /**
     * Registering AvoRed Assets.
     * @return void
     */
    public function registerAssets()
    {
        Asset::registerJS(function (AssetItem $item) {
            $item->key('avored.admin.review.js')
                ->path(__DIR__ . '/../dist/js/admin-review.js');
        });
        Asset::registerJS(function (AssetItem $item) {
            $item->key('avored.review.js')
                ->path(__DIR__ . '/../dist/js/review.js');
        });
    }
    /**
     * Registering AvoRed featured Resource
     * e.g. Route, View, Database  & Translation Path
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
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('avored-review::admin.review.tab', ProductReviewComposer::class);
    }

    /**
     * Register the Product Edit View Composer Class.
     * @return void
     */
    protected function registerTab()
    {
        Tab::put('catalog.product', function (TabItem $tab) {
            $tab->key('catalog.product.review')
                ->label('avored-review::review.product-tab')
                ->view('avored-review::admin.review.tab');
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
