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
namespace Mage2\Ecommerce\AdminMenu;

use Illuminate\Support\Facades\Route;
use Mage2\Ecommerce\AdminMenu\Contracts\AdminMenu as AdminMenuContracts;

class AdminMenu implements AdminMenuContracts
{

    /**
     *
     *
     * @var string $label
     */
    protected $label;

    /**
     *
     *
     * @var array $menuItems
     */
    protected $subMenu;

    /**
     *
     *
     * @var string $key
     */
    protected $key;


    /**
     *
     *
     * @var string $routeName
     */
    protected $routeName;

    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;
            return $this;
        }

        return $this->label;
    }

    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;
            return $this;
        }

        return $this->key;
    }

    public function route($routeName = null)
    {
        if (null !== $routeName) {
            $this->routeName = $routeName;
            return $this;
        }

        return $this->routeName;
    }

    public function subMenu($key = null, $menuItem = null)
    {
        if (null !== $key) {
            $this->subMenu[$key] = $menuItem;
            return $this;
        }

        return $this->subMenu;
    }

    public function menuClass()
    {
        $currentRouteName = Route::currentRouteName();
        $found = false;

        if(count($this->subMenu()) > 0) {
            foreach($this->subMenu() as $menu) {
                if($menu->route() == $currentRouteName) {
                    $found = true;
                }
            }
        }

        if(false === $found) {
            return 'd-none';
        } else {
            return '';
        }

    }


}