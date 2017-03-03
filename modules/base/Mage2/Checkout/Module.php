<?php

namespace Mage2\Checkout;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

class Module extends BaseModule {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerModule();
        $this->registerViewComposer();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mapWebRoutes();
        $this->registerViewPath();
        $this->registerTranslationPath();
    }

    protected function registerTranslationPath() {
        $this->loadTranslationsFrom(__DIR__. "/views/lang", "mage2checkout");
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function mapWebRoutes() {
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__ . '/views');
    }

    protected function registerViewComposer() {

        View::composer(
                ['checkout.index', 'checkout.shipping-address'], 'Mage2\Checkout\ViewComposers\CheckoutComposer'
        );
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 Checkout';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-checkout';
    }
    
    public function getPath() {
        return __DIR__;
    }

}
