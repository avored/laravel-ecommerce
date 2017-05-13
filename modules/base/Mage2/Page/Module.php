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
namespace Mage2\Page;

use Illuminate\Support\Facades\View;
use Mage2\Framework\AdminMenu\Facades\AdminMenu;
use Mage2\Framework\Auth\Facades\Permission;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;

class Module extends BaseModule {

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
        $this->registerAdminMenu();
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
        $this->registerPermissions();


    }

    protected function registerTranslationPath() {
        $this->loadTranslationsFrom(__DIR__. "/views/lang", "mage2page");
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
        $this->loadViewsFrom(__DIR__. '/views', 'mage2page');
        View::addLocation(__DIR__ . DIRECTORY_SEPARATOR .'views');
    }

    public function registerAdminMenu() {
        $adminMenu = [ 'page' => [
                'label' => 'Pages',
                'route' => 'admin.page.index',
        ]];
        AdminMenu::registerMenu('mage2-page', $adminMenu);
    }

    /**
     *  Register Permission for the roles
     *
     * @return void
     */
    protected function registerPermissions() {

        $permissions = [
            ['title' => 'Order List', 'routes' => 'admin.order.index'],
            ['title' => 'Order View, Send Email Invoice to Customer', 'routes' => "admin.order.view,admin.order.send-email-invoice"],
            ['title' => 'Order Update Status', 'routes' => "admin.order.change-status,admin.order.update-status"],
        ];

        foreach ($permissions as $permission) {
            Permission::add($permission);
        }
    }

    public function registerModule() {
        ModuleFacade::put($this->getIdentifier(), $this, $type = 'system');
    }

    public function getName() {
        return 'Mage2 Page';
    }

    public function getNameSpace() {
        return __NAMESPACE__;
    }

    public function getIdentifier() {
        return 'mage2-page';
    }

    public function getPath() {
        return __DIR__;
    }
}
