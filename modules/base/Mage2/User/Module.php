<?php

namespace Mage2\User;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\User\Middleware\AdminAuthenticate;
use Mage2\User\Middleware\FrontAuthenticate;
use Mage2\User\Middleware\RedirectIfAdminAuthenticated;
use Mage2\User\Middleware\RedirectIfFrontAuthenticated;
use Illuminate\Support\Facades\Gate;
use Mage2\User\Policies\AdminUserPolicy;
use Mage2\User\Models\AdminUser;
use Mage2\User\Middleware\Permission;
use Mage2\Framework\Auth\Facades\Permission as PermissionFacade;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
use Mage2\Framework\Auth\Access\Permission as PermissionTest;

class Module extends BaseModule {

    protected $policies = [
        AdminUser::class => AdminUserPolicy::class,
    ];

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
        $this->registerMiddleware();
        $this->registerAdminMenu();
        $this->registerPolicies();
        $this->registerViewComposerData();
        $this->registerTranslationPath();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->mapWebRoutes();
        $this->registerViewPath();
        $this->registerAdminConfiguration();
        $this->registerPermissions();
    }

    /**
     * Register the policy for the admin user
     *
     * @return void
     */
    public function registerPolicies() {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    public function registerViewComposerData() {
        View::composer(['user.my-account.sidebar'], 'Mage2\User\ViewComposers\MyAccountSidebarComposer');
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware() {
        $router = $this->app['router'];

        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('adminauth', AdminAuthenticate::class);
        $router->aliasMiddleware('adminguest', RedirectIfAdminAuthenticated::class);
        $router->aliasMiddleware('frontauth', FrontAuthenticate::class);
        $router->aliasMiddleware('frontguest', RedirectIfFrontAuthenticated::class);
    }


    /**
     * Register Admin Configuration for the Address Modules
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function registerAdminConfiguration() {
        $adminConfigurations[] = [
            'title' => 'Address Configuration',
            'description' => 'Set Default Country for Store',
            'edit_action' => 'admin.configuration.address',
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
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
        $this->loadViewsFrom(__DIR__. '/views', 'mage2user');
        View::addLocation(__DIR__ . '/views');
    }

    protected function registerTranslationPath() {
        $this->loadTranslationsFrom(__DIR__. "/views/lang", "mage2user");
    }


    public function registerAdminMenu() {
        $adminUserMenu = [ 'user' => [
                'label' => 'Users',
                'route' => '#',
                'submenu' => ['admin-users' => [
                        'label' => 'Admin Users',
                        'route' => 'admin.admin-user.index',
                    ],
                    /*
                    'roles' =>
                    [
                        'label' => 'Roles',
                        'route' => 'admin.role.index',
                    ]
                    */
                    ]
        ]];
        AdminMenu::registerMenu('mage2-user', $adminUserMenu);
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [

            /**
            ['title' => 'Role List', 'routes' => 'admin.role.index'],
            ['title' => 'Role Create', 'routes' => "admin.role.create,admin.role.store"],
            ['title' => 'Role Edit', 'routes' => "admin.role.edit,admin.role.update"],
            ['title' => 'Role Destroy', 'routes' => "admin.role.destroy"],
             */
            ['title' => 'Admin User List', 'routes' => 'admin.admin-user.index'],
            ['title' => 'Admin User Create', 'routes' => "admin.admin-user.create,admin.admin-user.store"],
            ['title' => 'Admin User  Edit', 'routes' => "admin.admin-user.edit,admin.admin-user.update"],
            ['title' => 'Admin User  Destroy', 'routes' => "admin.admin-user.destroy"],
        ];

        foreach ($permissions as $permission) {
            PermissionFacade::add($permission);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 User';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-user';
    }
    
    public function getPath() {
        return __DIR__;
    }

}
