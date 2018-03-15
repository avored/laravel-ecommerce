<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Repository\Page;
use AvoRed\Ecommerce\Http\Requests\PageRequest;
use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Framework\Widget\Facade as Widget;

class PageController extends AdminController
{

    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Page
     */
    protected $pageRepository;


    /**
     * Page Controller constructor to Set AvoRed Ecommerce Page Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\Page $pageRepository
     * @return void
     */
    public function __construct(Page $pageRepository)
    {
        $this->pageRepository   = $pageRepository;
    }


    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model($this->pageRepository->model()->query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->column('slug')
            ->column('meta_title')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.page.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-page-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.page.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-page-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('avored-ecommerce::admin.page.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin.page.create');
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
        $this->pageRepository->model()->create($request->all());

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
        $page = $this->pageRepository->model()->findorfail($id);
        $widgetOptions = Widget::allOptions();


        return view('avored-ecommerce::admin.page.edit')
            ->with('model', $page)
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Update the specified page in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\Page $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page = $this->pageRepository->model()->findorfail($id);
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
        $this->pageRepository->model()->destroy($id);

        return redirect()->route('admin.page.index');
    }
}
