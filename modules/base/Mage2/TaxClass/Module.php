<?php

namespace Mage2\TaxClass;

use Illuminate\Support\Facades\View;
use Mage2\Framework\System\View\Facades\AdminConfiguration;
use Mage2\Framework\Support\BaseModule;

class Module extends BaseModule
{
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
    public function boot()
    {
        $this->registerAdminConfiguration();
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerWebRoute();
        $this->registerViewPath();
    }

   

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    protected function registerWebRoute() {
        require (__DIR__ . "/routes/web.php");
    }
    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title'       => 'Tax Configuration',
            'description' => 'Defined the amount of tax applied to product.',
            'edit_action' =>'admin.configuration.tax-class',
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }
}
