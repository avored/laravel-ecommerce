<?php

namespace Mage2\Catalog\Controllers\Admin;

use Illuminate\Support\Collection;
use Mage2\Catalog\Models\Category;
use Mage2\Catalog\Requests\CategoryRequest;
use Mage2\Framework\DataGrid\DataGrid;
use Mage2\System\Controllers\Controller;
use Mage2\Framework\DataGrid\DataGridFacade;
class CategoryController extends Controller
{
    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        $category = new Category();
        $dataGrid = DataGridFacade::make($category);

        $dataGrid->addColumn(DataGrid::textColumn('name','Category Name'));
        $dataGrid->addColumn(DataGrid::textColumn('slug','Category Slug'));
        $dataGrid->addColumn(DataGrid::textColumn('parent_name','Parent Category Name'));
        $dataGrid->addColumn(DataGrid::linkColumn('edit','Edit',function($label , $row) {
            return "<a href='". route('admin.category.edit', $row->id)."'>Edit</a>";
        }));

        $dataGrid->addColumn(DataGrid::linkColumn('destroy','Destroy',function($label , $row) {
            return "<form method='post' action='".route('admin.category.destroy', $row->id)."'>" .
                    csrf_field() .
                    '<a href="#" onclick="jQuery(this).parents("form:first").submit()">Destroy</a>'.
                    "</form>";
        }));

        //Form::open(['method' => 'DELETE', 'route' => ['admin.category.destroy',$category->id]]) !!}
        //<a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
        //Form::close()

        return view('admin.catalog.category.index')
                ->with('categories', $categories)
                ->with('dataGrid', $dataGrid)
                ;
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryOptions = $this->_getCategoryOptions();

        return view('admin.catalog.category.create')
                ->with('categoryOptions', $categoryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->merge(['website_id' => $this->websiteId]);
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

        return view('admin.catalog.category.edit')
            ->with('category', $category)
            ->with('categoryOptions', $categoryOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CategoryRequest $request
     * @param int                                $id
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
        Category::destroy($id);

        return redirect()->route('admin.category.index');
    }

    private function _getCategoryOptions()
    {
        $options = Collection::make(['0' => 'please select'] + Category::pluck('name', 'id')->toArray())->toArray();

        return $options;
    }
}
