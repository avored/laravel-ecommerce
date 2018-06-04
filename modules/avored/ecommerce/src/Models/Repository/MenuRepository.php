<?php

namespace AvoRed\Ecommerce\Models\Repository;

use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Ecommerce\Models\Contracts\MenuInterface;

class MenuRepository implements MenuInterface
{
    /**
     * Find an Menu by given Id
     *
     * @param $id
     * @return \AvoRed\Ecommerce\Models\Menu
     */
    public function find($id)
    {
        return Menu::find($id);
    }

    /**
     * Get Collection for All Parents Menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parentsAll()
    {
        return Menu::whereParentId(null)->orWhere('parent_id','=',0)->get();
    }

      /**
     * Get all Menu
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Menu::all();
    }

    /**
     * Paginate Menu
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Menu::paginate($noOfItem);
    }

    /**
     * Get an Menu Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Menu::query();
    }

    /**
     * Find an Menu Query
     *
     * @return \AvoRed\Ecommerce\Models\Menu
     */
    public function create($data)
    {
        return Menu::create($data);
    }

    /**
     * 
     * @param array $menus
     * @return \AvoRed\Ecommerce\Models\Repository\MenuRepository
     */
     public function truncateAndCreateMenus($menus) 
     {

        Menu::truncate();
        foreach ($menus as $menu) {
            $this->_saveMenu($menu);
        }
       
     }

     private function _saveMenu($menus, $parentId = null) {

        foreach ($menus as $menu) {
            $menuModel = $this->create(['name' => $menu->name,
                                        'route' => $menu->route,
                                        'params' => $menu->params,
                                        'parent_id' => $parentId]);

            if(isset($menu->children) && count($menu->children[0]) >0) {
                $this->_saveMenu($menu->children[0], $menuModel->id);
            }

        }
}
}
