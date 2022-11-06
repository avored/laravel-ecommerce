<?php
/**
 * AvoRed E commerce built for Laravel Shopping Cart Solution
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2017-2018 AvoRed
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://www.avored.com
 */

namespace AvoRed\DummyData;

use Illuminate\Support\ServiceProvider;

class Module extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    ///protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
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

    public function publishFiles()
    {
        $this->publishes([__DIR__ . '/../assets' => storage_path('app/public')], 'public');
    }
}
