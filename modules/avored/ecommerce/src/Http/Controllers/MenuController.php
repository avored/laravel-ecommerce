<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Category;
use Illuminate\Http\Request;
use AvoRed\Framework\Menu\Facade as MenuFacade;

class MenuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frontMenus = MenuFacade::all();

        $categories = Category::all();
        $menus = Menu::whereParentId(null)->orWhere('parent_id','=',0)->get();
        return view('avored-ecommerce::menu.index')
                    ->with('categories', $categories)
                    ->with('frontMenus', $frontMenus)
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


                $menuModel = Menu::create(['name' => $menu->name,
                                            'route' => $menu->route,
                                            'params' => $menu->params,
                                            'parent_id' => $parentId]);

                if(isset($menu->children) && count($menu->children[0]) >0) {
                    $this->_saveMenu($menu->children[0], $menuModel->id);
                }

            }
    }

}
