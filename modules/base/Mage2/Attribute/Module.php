<?php
namespace Mage2\Attribute;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

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
        $this->registerModule();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewPath();
    }

   

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }


    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this);
    }


    public function getName() {
        return 'Mage2 Attribute';
    }

    public function getIdentifier() {
        return 'mage2-attribute';
    }
}
