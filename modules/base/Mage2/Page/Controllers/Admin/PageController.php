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
namespace Mage2\Page\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Page\Models\Page;
use Mage2\Page\Requests\PageRequest;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
use Mage2\Framework\DataGrid\Facades\DataGrid;

class PageController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new Page());
    }


    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
        $model = new Page();
        $dataGrid = DataGrid::make($model);

        $dataGrid->addColumn(DataGrid::textColumn('id', 'Page Id'));
        $dataGrid->addColumn(DataGrid::textColumn('title', 'Page Title'));
        $dataGrid->addColumn(DataGrid::textColumn('slug', 'Page Slug'));
        $dataGrid->addColumn(DataGrid::textColumn('meta_title', 'Page Meta Title'));

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.page.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.page.edit', $row->id) . "'>Edit</a>";
            }));
        }


        if (Gate::allows('hasPermission', [AdminUser::class, "admin.page.destroy"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.page.destroy', $row->id) . "'>" .
                "<input type='hidden' name='_method' value='delete'/>" .
                csrf_field() .
                '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                "</form>";
            }));
        }
         */


        return view('mage2page::admin.page.index');
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2page::admin.page.create');
    }

    /**
     * Store a newly created page in database.
     *
     * @param \Mage2\Page\Requests\PageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Display the specified page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findorfail($id);

        return view('mage2page::admin.page.edit')
                        ->with('page', $page);
    }

    /**
     * Update the specified page in database.
     *
     * @param \Mage2\Page\Requests\Page $request
     * @param int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page = Page::findorfail($id);
        $page->update($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified page from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::destroy($id);

        return redirect()->route('admin.page.index');
    }
}
