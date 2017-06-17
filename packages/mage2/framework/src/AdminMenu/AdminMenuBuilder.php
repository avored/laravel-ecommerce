<?php
namespace Mage2\Framework\AdminMenu;

use Illuminate\Support\Collection;

class AdminMenuBuilder
{
    protected $adminMenu;

    public function __construct()
    {
        $this->adminMenu = Collection::make([]);
    }

    public function registerMenu($menuKey, $adminMenu)
    {
        if ($this->adminMenu->has($menuKey)) {

            $item = $this->adminMenu->get($menuKey);
            $mergeMenuItems = array_merge_recursive($item, $adminMenu);

            $this->adminMenu->put($menuKey, $mergeMenuItems);
        } else {
            $this->adminMenu->put($menuKey, $adminMenu);
        }
    }

    public function getMenuItems()
    {
        return $this->adminMenu->all();
    }
}
