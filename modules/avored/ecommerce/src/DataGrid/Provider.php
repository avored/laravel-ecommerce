<?php
namespace AvoRed\Ecommerce\DataGrid;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider {

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
    public function register() {

        $this->registerDataGrid();
        $this->app->alias('datagrid', 'AvoRed\Ecommerce\DataGrid\Manager');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerDataGrid() {
        $this->app->singleton('datagrid', function ($app) {

            $request  = $app->request;
            return new Manager($request);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [ 'datagrid', 'AvoRed\Ecommerce\DataGrid\Manager'];
    }

}
