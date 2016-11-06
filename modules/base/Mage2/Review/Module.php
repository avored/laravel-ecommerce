<?php

namespace Mage2\Review;

use Illuminate\Support\Facades\View;
use Mage2\System\View\Facades\AdminMenu;
use Mage2\Framework\Support\Facades\Permission;
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
        $adminMenu = [
            'label' => 'Review',
            'route'   => 'admin.review.index',
        ];
        AdminMenu::registerMenu($adminMenu);
    }
    
   /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {
        $permissions = [
            ['title' => 'Review List',     'routes' => 'admin.review.index'],
            ['title' => 'Review Create',   'routes' => "admin.review.create,admin.review.store"],
            ['title' => 'Review Edit',     'routes' => "admin.review.edit,admin.review.update"],
            ['title' => 'Review Destroy',  'routes' => "admin.review.destroy"],
            
          
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }
}
