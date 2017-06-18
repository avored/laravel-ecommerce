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
namespace Mage2\Category\Controllers\Admin;

use Illuminate\Support\Collection;
use Mage2\Category\Models\Category;
use Mage2\Category\Requests\CategoryRequest;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Illuminate\Support\Facades\Gate;
use Mage2\User\Models\AdminUser;

class CategoryController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new Category());
    }


    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('mage2categoryadmin::catalog.category.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryOptions = $this->_getCategoryOptions();

        return view('mage2categoryadmin::catalog.category.create')
            ->with('categoryOptions', $categoryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Category\Requests\CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        Category::create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryOptions = $this->_getCategoryOptions();
        $category = Category::findorfail($id);

        return view('mage2categoryadmin::catalog.category.edit')
            ->with('category', $category)
            ->with('categoryOptions', $categoryOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Category\Requests\CategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findorfail($id);

        $category->update($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();

        return redirect()->route('admin.category.index');
    }

    private function _getCategoryOptions()
    {
        $options = Collection::make([0 => 'please select'] + Category::pluck('name', 'id')->toArray())->toArray();

        return $options;
    }

}
