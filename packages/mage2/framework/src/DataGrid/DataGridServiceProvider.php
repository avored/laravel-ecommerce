<?php

namespace Mage2\Framework\DataGrid;

use Illuminate\Support\ServiceProvider;
use Mage2\Framework\DataGrid\DataGridManager;

class DataGridServiceProvider extends ServiceProvider
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

        $this->registerDataGrid();
        $this->registerViewPath();
        $this->app->alias('datagrid', 'Mage2\Framework\DataGrid\DataGridManager');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerDataGrid()
    {
        $this->app->singleton('datagrid', function ($app) {

            $request = $app->request;
            return new DataGridManager($request);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['datagrid', 'Mage2\Framework\DataGrid\DataGridManager'];
    }

    /**
     * Define the view path for the datagrid namespace.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    public function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'datagrid');
    }

}
