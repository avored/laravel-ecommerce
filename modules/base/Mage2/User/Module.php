<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */


namespace Mage2\User;

use Illuminate\Support\Facades\Event;
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
use Mage2\User\Events\UserRegisteredEvent;
use Mage2\User\Listeners\RegisteredUserListener;

class Module extends BaseModule
{

    /**
     *
     * Module Name Variable
     * @var $name
     *
     */
    protected $name = NULL;

    /**
     *
     * Module Odentifier  Variable
     * @var $identifier
     *
     */
    protected $identifier = NULL;
    /**
     *
     * Module Description Variable
     * @var $description
     *
     */
    protected $description = NULL;

    /**
     *
     * Module Enable Variable
     * @var $enable
     *
     */
    protected $enable = NULL;


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
    public function boot()
    {
        if (true === $this->getEnable()) {
            $this->registerModule();
            $this->registerMiddleware();
            $this->registerAdminMenu();
            $this->registerPolicies();
            $this->registerViewComposerData();
            $this->registerTranslationPath();
            Event::listen(UserRegisteredEvent::class, RegisteredUserListener::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerModuleYamlFile(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'module.yaml');
        if (true === $this->getEnable()) {
            $this->mapWebRoutes();
            $this->registerViewPath();
            $this->registerPermissions();
        }
    }

    /**
     * Register the policy for the admin user
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    public function registerViewComposerData()
    {
        View::composer(['user.my-account.sidebar'], 'Mage2\User\ViewComposers\MyAccountSidebarComposer');
    }

    /**
     * Register the middleware for the mage2 auth modules.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('adminauth', AdminAuthenticate::class);
        $router->aliasMiddleware('adminguest', RedirectIfAdminAuthenticated::class);
        $router->aliasMiddleware('frontauth', FrontAuthenticate::class);
        $router->aliasMiddleware('frontguest', RedirectIfFrontAuthenticated::class);
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
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'mage2user');
        View::addLocation(__DIR__ . '/views');
    }

    protected function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__ . "/views/lang", "mage2user");
    }


    public function registerAdminMenu()
    {
        $adminUserMenu = ['user' => [
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
    protected function registerPermissions()
    {

        $permissions = [

            /**
             * ['title' => 'Role List', 'routes' => 'admin.role.index'],
             * ['title' => 'Role Create', 'routes' => "admin.role.create,admin.role.store"],
             * ['title' => 'Role Edit', 'routes' => "admin.role.edit,admin.role.update"],
             * ['title' => 'Role Destroy', 'routes' => "admin.role.destroy"],
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

    public function registerModule()
    {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getNameSpace()
    {
        return __NAMESPACE__;
    }

    public function getPath()
    {
        return __DIR__;
    }

}
