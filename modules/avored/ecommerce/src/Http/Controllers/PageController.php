<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Ecommerce\Models\Database\Page as Model;
use AvoRed\Framework\Widget\Facade as Widget;
use AvoRed\Ecommerce\DataGrid\Page as PageGrid;
use AvoRed\Ecommerce\Http\Requests\PageRequest;
use AvoRed\Ecommerce\Models\Contracts\PageInterface;

class PageController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\PageRepository
     */
    protected $repository;

    public function __construct(PageInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageGrid = new PageGrid($this->repository->query()->orderBy('id', 'desc'));

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
        $this->repository->create($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param \AvoRed\Ecommerce\Models\Database\Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $page)
    {
        $widgetOptions = Widget::allOptions();

        return view('avored-ecommerce::page.edit')
            ->with('model', $page)
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Update the specified page in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\PageRequest $request
     * @param \AvoRed\Ecommerce\Models\Database\Page $page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Model $page)
    {
        $page->update($request->all());
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified page from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Model $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index');
    }
}
