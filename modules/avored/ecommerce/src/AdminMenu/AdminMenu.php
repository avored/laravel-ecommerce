<?php
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
     * @var string $icon
     */
    protected $icon;

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

    public function icon($icon = null)
    {
        if (null !== $icon) {
            $this->icon = $icon;
            return $this;
        }

        return $this->icon;
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