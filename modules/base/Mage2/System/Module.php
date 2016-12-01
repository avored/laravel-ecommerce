<?php

namespace Mage2\System;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Support\Facades\Permission;
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
        $this->registerAdminMenu();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();
        $this->registerViewPath();
        $this->registerPermissions();
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
    protected function mapWebRoutes()
    {
        require __DIR__.'/routes/web.php';
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__.'/views');
    }

    public function registerAdminMenu()
    {
        $adminMenu = [ 'system' => [
            'label' => 'System',
            'route'   => '#',
            'submenu' => ['module' => [
                            'label' => 'Module',
                            'route' => 'admin.module.index',
                            ]
                        ]
        ]];
        AdminMenu::registerMenu('mage2-system',$adminMenu);
    }
    
       
   /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {
        //
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this);
    }


    public function getName() {
        return 'Mage2 System';
    }

    public function getIdentifier() {
        return 'mage2-system';
    }
}
