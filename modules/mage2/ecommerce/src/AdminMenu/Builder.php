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
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\AdminMenu;

use Illuminate\Support\Collection;

class Builder
{

    /**
     * Admin Menu Collection
     *
     * @var \Illuminate\Support\Collection
     */
    protected $adminMenu;

    public function __construct()
    {
        $this->adminMenu = Collection::make([]);
    }


    /**
     * Create new menu object and return
     *
     * @var string $key
     * @return \Mage2\Ecommerce\AdminMenu\AdminMenu
     */
    public function add($key) {
        $menu = new AdminMenu();
        $menu->key($key);
        $this->adminMenu->put($key, $menu);

        return $menu;
    }


    /**
     * Return Admin Menu Object
     *
     * @var string $key
     * @return \Mage2\Ecommerce\AdminMenu\AdminMenu
     */
    public function get($key) {

        return $this->adminMenu->get($key);
    }


    /**
     * Register an Admin Menu
     *
     * @param string $menuKey
     * @param string $adminMenu
     * @return void
     */
    public function registerMenu($menuKey, $adminMenu)
    {
        if ($this->adminMenu->has($menuKey)) {

            /** @var  \Mage2\Ecommerce\AdminMenu\AdminMenu $adminMenuObj */
            $adminMenuObj = $this->adminMenu->get($menuKey);

            foreach($adminMenu as $key => $menuArray) {

                if(isset($menuArray['submenu'])) {
                    $menus = $menuArray['submenu'];
                    foreach($menus as $subKey => $subArray) {
                        $subObj = new AdminMenu;
                        $subObj->key($subKey)
                                ->label($subArray['label'])
                                ->route($subArray['route']);

                        $adminMenuObj->subMenu($subKey,$subObj);
                    }
                }
            }

            $this->adminMenu->put($menuKey, $adminMenuObj);
        } else {
            $adminMenuObj = new AdminMenu;
            foreach ($adminMenu as $key => $menuArray) {

                $flag = true;

                $adminMenuObj->key($key);

                if (isset($menuArray['label'])) {
                    $adminMenuObj->label($menuArray['label']);
                } else {
                    $flag = false;
                }
                if (isset($menuArray['route'])) {
                    $adminMenuObj->route($menuArray['route']);
                } else {
                    $flag = false;
                }
            }

            if (false !== $flag) {
                $this->adminMenu->put($menuKey, $adminMenuObj);
            }

        }
    }

    /**
     * Return all available Menu in Admin Menu
     *
     *
     * @param void
     * @return \Illuminate\Support\Collection
     */

    public function getMenuItems()
    {
        return $this->adminMenu->all();
    }
}
