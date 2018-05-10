<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Page as Model;
use AvoRed\Framework\Widget\Facade as Widget;
use AvoRed\Ecommerce\DataGrid\Page as PageGrid;
use AvoRed\Ecommerce\Http\Requests\PageRequest;

class PageController extends Controller
{

    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageGrid = new PageGrid(Model::query()->orderBy('id', 'desc'));

        return view('avored-ecommerce::page.index')->with('dataGrid', $pageGrid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $widgetOptions = Widget::allOptions();

        return view('avored-ecommerce::page.create')
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Store a newly created page in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\PageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Model::create($request->all());

        return redirect()->route('admin.page.index');
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
        $page = Model::find($id);
        $widgetOptions = Widget::allOptions();

        return view('avored-ecommerce::page.edit')
            ->with('model', $page)
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Update the specified page in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\PageRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page = Model::find($id);
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
        Model::destroy($id);

        return redirect()->route('admin.page.index');
    }
}
