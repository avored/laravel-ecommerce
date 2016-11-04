<?php

namespace Mage2\Attribute;

use Illuminate\Support\Facades\View;
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
        //
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

  
}
