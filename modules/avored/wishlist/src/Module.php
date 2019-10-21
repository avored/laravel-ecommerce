<?php
namespace AvoRed\Wishlist;

use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use AvoRed\Wishlist\Database\Repository\WishlistRepository;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WishlistModelInterface::class, WishlistRepository::class);
    }

    /**
     * Registering avored wishlist Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'a-wishlist');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        //$this->loadViewsFrom(__DIR__ . '/../resources/views', 'a-wishlist');
    }
}
