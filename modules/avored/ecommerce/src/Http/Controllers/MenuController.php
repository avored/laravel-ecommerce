<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Category;
use Illuminate\Http\Request;
use AvoRed\Framework\Menu\Facade as MenuFacade;
use AvoRed\Ecommerce\Models\Repository\MenuRepository;
use AvoRed\Ecommerce\Models\Contracts\MenuInterface;

class MenuController extends Controller
{

    /**
     *
     * @var \AvoRed\Ecommerce\Models\Repository\MenuRepository
     */
    protected $repository;

    public function __construct(MenuInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frontMenus = MenuFacade::all();
        $categories = Category::all();
        $menus      = $this->repository->parentsAll();

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
        $menuJson   = $request->get('menu_json');
        $menuArray  = json_decode($menuJson);
    
        $this->repository->truncateAndCreateMenus($menuArray);

        return redirect()->route('admin.menu.index')
                        ->with('notificationText','Menu Save Successfully!!');
    }
}
