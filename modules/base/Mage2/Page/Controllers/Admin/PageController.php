<?php

namespace Mage2\Page\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Page\Models\Page;
use Mage2\Page\Requests\PageRequest;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
use Mage2\Framework\DataGrid\DataGridFacade as DataGrid;

class PageController extends AdminController
{
    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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


        return view('admin.page.index')
                        ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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

        return view('admin.page.edit')
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
