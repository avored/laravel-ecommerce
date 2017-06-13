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
namespace Mage2\Catalog;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Auth\Facades\Permission;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
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
            $this->registerAdminConfiguration();
            $this->registerViewPath();
            $this->registerTranslationPath();
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
            $this->registerViewComposerData();
            $this->registerPermissions();
        }

    }

    protected function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__ . "/views/lang", "mage2catalog");
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
        $this->loadViewsFrom(__DIR__ . '/views', 'mage2catalog');
        View::addLocation(__DIR__ . '/views');
    }

    public function registerAdminMenu()
    {

        $adminUserMenu = ['catalog' => [
            'label' => 'Catalog',
            'route' => '#',
            'submenu' => [
                'category' => [
                    'label' => 'Category',
                    'route' => 'admin.category.index',
                ]
                , 'product' => [
                    'label' => 'Product',
                    'route' => 'admin.product.index',
                ]
                , 'attribute' => [
                    'label' => 'Attribute',
                    'route' => 'admin.attribute.index',
                ]

                /**, 'option' => [
                 * 'label' => 'Option',
                 * 'route' => 'admin.option.index',
                 * ]*/
                , 'review' => [
                    'label' => 'Review',
                    'route' => 'admin.review.index',
                ]
            ]
        ]];
        AdminMenu::registerMenu('mage2-catalog', $adminUserMenu);
    }

    public function registerAdminConfiguration()
    {
        $adminConfigurations[] = [
            'title' => 'Catalog Configuration',
            'description' => 'Some Description for Catalog Modules',
            'edit_action' => 'admin.configuration.catalog',
            'sort_order' => 1
        ];

        foreach ($adminConfigurations as $adminConfiguration) {
            AdminConfiguration::registerConfiguration($adminConfiguration);
        }
    }

    public function registerViewComposerData()
    {
        //View::composer(['admin.catalog.product.boxes.inventory'], 'Mage2\Catalog\ViewComposers\ProductBoxInventoryComposer');
        View::composer(['mage2catalog::admin.catalog.product.edit'], 'Mage2\Catalog\ViewComposers\ProductFieldComposer');
        View::composer(['mage2catalog::admin.catalog.product.create'], 'Mage2\Catalog\ViewComposers\ProductFieldComposer');
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions()
    {

        $permissions = [
            ['title' => 'Category List', 'routes' => 'admin.category.index'],
            ['title' => 'Category Create', 'routes' => "admin.category.create,admin.category.store"],
            ['title' => 'Category Edit', 'routes' => "admin.category.edit,admin.category.update"],
            ['title' => 'Category Destroy', 'routes' => "admin.category.destroy"],
            ['title' => 'Product List', 'routes' => 'admin.product.index,admin.product.search'],
            ['title' => 'Product Create ', 'routes' => "admin.product.create,admin.product.store,admin.product.upload-image"],
            ['title' => 'Product Edit', 'routes' => "admin.product.edit,admin.product.update,admin.product.search,admin.product.upload-image"],
            ['title' => 'Product Destroy', 'routes' => "admin.product.destroy", 'admin.product.search'],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
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
