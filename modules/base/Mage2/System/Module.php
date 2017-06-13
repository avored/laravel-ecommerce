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

namespace Mage2\System;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Auth\Facades\Permission;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;


class Module extends BaseModule
{

    /**
     *
     * Module Name Variable
     * @var name
     *
     */
    protected $name = NULL;

    /**
     *
     * Module Odentifier  Variable
     * @var identifier
     *
     */
    protected $identifier = NULL;
    /**
     *
     * Module Description Variable
     * @var description
     *
     */
    protected $description = NULL;

    /**
     *
     * Module Enable Variable
     * @var enable
     *
     */
    protected $enable = NULL;


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
            $this->registerAdminMenu();
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
            $this->registerViewComposer();
            $this->registerAdminConfiguration();
            $this->registerPermissions();
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
    protected function mapWebRoutes()
    {
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . "/views", 'mage2system');
        View::addLocation(__DIR__ . '/views');
    }

    /**
     *
     *
     * @return void
     */
    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title' => 'General Configuration',
            'description' => 'General System Settings',
            'edit_action' => 'admin.configuration.general',
            'sort_order' => 0
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

    public function registerAdminMenu()
    {
        $adminMenu = ['system' => ['submenu' => ['theme' => [
            'label' => 'Themes',
            'route' => 'admin.theme.index',
        ]]]];
        AdminMenu::registerMenu('mage2-system', $adminMenu);
        $adminMenu = ['system' => [
            'label' => 'System',
            'route' => '#',
            'submenu' => [
                'module' => [
                    'label' => 'Module',
                    'route' => 'admin.module.index',
                ],
                'configuration' => [
                    'label' => 'Configuration',
                    'route' => 'admin.configuration',
                ]
            ]
        ]];
        AdminMenu::registerMenu('mage2-system', $adminMenu);
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions()
    {

        $permissions = [
            ['title' => 'Theme List', 'routes' => 'admin.theme.index'],
            ['title' => 'Theme Upload', 'routes' => "admin.theme.create,admin.theme.store"],
            ['title' => 'Theme Activate', 'routes' => "admin.theme.activate"],
            ['title' => 'Theme Destroy', 'routes' => "admin.theme.destroy"],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }

    protected function registerViewComposer()
    {
        View::composer(['layouts.admin-nav', 'layouts.admin-nav'], 'Mage2\System\ViewComposers\AdminNavComposer');

        View::composer(['layouts.app'], 'Mage2\System\ViewComposers\LayoutAppComposer');
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
