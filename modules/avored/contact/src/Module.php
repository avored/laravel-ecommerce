<?php

namespace AvoRed\Contact;

use Illuminate\Support\ServiceProvider;
use AvoRed\Framework\Menu\Menu;
use AvoRed\Framework\Menu\Facades\Menu as MenuFacade;

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
        $this->registerFrontMenu();
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
     * Registering AvoRed Contact Resource
     * e.g. Route, View, Database  & Translation Path
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-contact');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-contact');
    }

    /**
     * Register the Publish Files
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ], 'avored-module-views');
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerFrontMenu()
    {
        MenuFacade::make('contact-us', function (Menu $accountMenu) {
            $accountMenu->label('Contact Us')
                ->route('contact.index');
        });
    }
}
