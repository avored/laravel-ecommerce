<?php
namespace AvoRed\Wishlist;

use AvoRed\Framework\Menu\MenuItem;
use AvoRed\Framework\Support\Facades\Menu;
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
        $this->registerMenu();
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
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-wishlist');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-wishlist');
    }

    protected function registerMenu()
    {
        Menu::make('account.wishlist.index', function (MenuItem $menu) {
            $menu->label('avored-wishlist::system.menu-label')
                ->type(MenuItem::FRONT)
                ->route('account.wishlist.index');
        });
    }
}
