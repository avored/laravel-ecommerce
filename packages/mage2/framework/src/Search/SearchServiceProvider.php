<?php
namespace Mage2\Framework\Search;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\Search\SearchManager;

class SearchServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerSearchManager();
        $this->app->alias('search', 'Mage2\Framework\Search\SearchManager');
    }

    /**
     * Register the Search Manager instance.
     *
     * @return void
     */
    protected function registerSearchManager()
    {
        $this->app->singleton('search', function () {
            return new SearchManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['search', 'Mage2\Framework\Search\SearchManager'];
    }
}