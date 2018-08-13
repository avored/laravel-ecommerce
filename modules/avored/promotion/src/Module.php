<?php

namespace AvoRed\Promotion;


use Illuminate\Support\ServiceProvider;

use AvoRed\Framework\AdminMenu\AdminMenu;

use AvoRed\Framework\AdminMenu\Facade as AdminMenuFacade;
use AvoRed\Framework\Widget\Facade as WidgetFacade;
use AvoRed\Framework\Tabs\Facade as TabFacade;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;

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
        $this->registerTab();
        $this->registerViewComposer();
        $this->registerListener();
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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-promotion');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-promotion');
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
        //View::composer('avored-related::related.admin.product.tab', RelatedProductComposer::class);
        //View::composer('avored-related::related.product.list', RelatedProductViewComposer::class);
    }


    /**
     * Register the Product Save Event Listener.
     *
     * @return void
     */
    protected function registerListener()
    {
        //Event::listen(ProductAfterSave::class, RelatedProductListener::class);
    }

    /**
     * Register the Product Edit Page Tab.
     *
     * @return void
     */
    protected function registerTab()
    {
        /**
        $relatedTab = new Tab();

        $relatedTab->type('product')
            ->label('Related Product')
            ->view('avored-related::related.admin.product.tab');

        TabFacade::add('related-product', $relatedTab);
         *
         */
    }

    /**
     * Register the Product Edit Page Tab.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
        $shopMenu = AdminMenuFacade::get('shop');

        $reviewMenu = new AdminMenu();
        $reviewMenu->key('promotion')
            ->label('Promotion')
            ->route('admin.promotion.index')
            ->icon('fas fa-leaf');

        $shopMenu->subMenu('promotion', $reviewMenu);
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

}