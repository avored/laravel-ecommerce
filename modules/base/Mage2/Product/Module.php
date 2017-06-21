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


namespace Mage2\Product;

use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\Framework\Configuration\Facades\AdminConfiguration;

class Module extends BaseModule
{

    /**
     *
     * Module Name Variable
     * @var string $name
     *
     */
    protected $name = NULL;

    /**
     *
     * Module identifier  Variable
     * @var string $identifier
     *
     */
    protected $identifier = NULL;
    /**
     *
     * Module Description Variable
     * @var string $description
     *
     */
    protected $description = NULL;

    /**
     *
     * Module Enable Variable
     * @var bool $enable
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
            $this->registerTranslationPath();
            $this->registerDatabasePath();
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
            $this->registerAdminMenu();
            $this->registerViewPath();
        }
    }

    public function registerDatabasePath()
    {
        $dbPath = $this->getPath() . DIRECTORY_SEPARATOR . "database";
        $this->loadMigrationsFrom($dbPath);
    }

    /**
     * Register Admin Menu for Mage2 Catalog Modules
     *
     */
    public function registerAdminMenu()
    {

        $adminMenu = ['catalog' => [
            'submenu' => [
                'product' => [
                    'label' => 'Product',
                    'route' => 'admin.product.index',
                ]
            ]
        ]];
        AdminMenu::registerMenu('mage2-catalog', $adminMenu);
    }


    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        require __DIR__ . '/routes/web.php';
    }

    protected function registerViewPath()
    {
        $this->loadViewsFrom(__DIR__ . '/views/admin', 'mage2productadmin');
        View::addLocation(__DIR__ . '/views');
    }



    protected function registerTranslationPath()
    {
        $this->loadTranslationsFrom(__DIR__ . "/views/lang", "mage2product");
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
