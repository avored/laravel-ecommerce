<?php

namespace Mage2\TaxClass;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
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
        $this->registerAdminConfiguration();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->registerWebRoute();
        $this->registerViewPath();
    }

    protected function registerViewPath() {
        $this->loadViewsFrom(__DIR__ . '/views', 'mage2taxclass');
        //View::addLocation(__DIR__ . '/views');
    }

    protected function registerWebRoute() {
        require (__DIR__ . "/routes/web.php");
    }

    public function registerAdminConfiguration() {
        $adminConfigurations[] = [
            'title' => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' => 'admin.configuration.tax-class',
            'sort_order' => 3
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 TaxClass';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-taxclass';
    }
    
    public function getPath() {
        return __DIR__;
    }

}
