<?php
namespace AvoRed\Related;

use AvoRed\Framework\Events\ProductAfterSave;
use AvoRed\Related\Http\ViewComposers\RelatedProductComposer;
use AvoRed\Related\Http\ViewComposers\RelatedProductViewComposer;
use AvoRed\Related\Listeners\RelatedProductListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Tabs\Tab;
use AvoRed\Framework\Tabs\Facade as TabFacade;
use AvoRed\Related\Models\Contracts\RelatedProductInterface;
use AvoRed\Related\Models\Repository\RelatedProductRepository;

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
        $this->registerTab();
        $this->registerViewComposer();
        $this->registerListener();
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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-related');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-related');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        //$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the Product Edit View Composer Class.
     *
     * @return void
     */
    protected function registerViewComposer()
    {
        View::composer('avored-related::related.admin.product.tab', RelatedProductComposer::class);
        View::composer('avored-related::related.product.list', RelatedProductViewComposer::class);
    }


    /**
     * Register the Product Save Event Listener.
     *
     * @return void
     */
    protected function registerListener()
    {
        Event::listen(ProductAfterSave::class, RelatedProductListener::class);
    }

    /**
     * Register the Product Edit Page Tab.
     *
     * @return void
     */
    protected function registerTab()
    {
        $relatedTab = new Tab();

        $relatedTab->type('product')
            ->label('Related Product')
            ->view('avored-related::related.admin.product.tab');

        TabFacade::add('related-product', $relatedTab);
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
        $this->app->bind(RelatedProductInterface::class, RelatedProductRepository::class);
    }
}