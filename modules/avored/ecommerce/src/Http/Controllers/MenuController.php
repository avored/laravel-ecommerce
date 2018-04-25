<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Http\Controllers\Admin\AdminController;
use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Category;
use Illuminate\Http\Request;

class MenuController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::whereParentId(null)->orWhere('parent_id','=',0)->get();
        return view('avored-ecommerce::menu.index')
                    ->with('categories', $categories)
                    ->with('menus', $menus);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menuJson = $request->get('menu_json');

        $menuArray = json_decode($menuJson);

        Menu::truncate();

        foreach ($menuArray as $menus) {
            $this->_saveMenu($menus);
        }

        return redirect()->route('admin.menu.index')
                        ->with('notificationText','Menu Save Successfully!!');
    }

    private function _saveMenu($menus, $parentId = null) {

            foreach ($menus as $menu) {

                $menuModel = Menu::create(['name' => $menu->name,'url' => $menu->url, 'parent_id' => $parentId]);

                if(isset($menu->children) && count($menu->children[0]) >0) {
                    $this->_saveMenu($menu->children[0], $menuModel->id);
                }

            }
    }

}
