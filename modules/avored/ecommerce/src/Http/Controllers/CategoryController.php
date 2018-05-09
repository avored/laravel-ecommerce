<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Models\Database\Category as Model;
use AvoRed\Ecommerce\DataGrid\Category;
use AvoRed\Ecommerce\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{


    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryGrid = new Category(Model::query());

        return view('avored-ecommerce::category.index')->with('dataGrid', $categoryGrid->dataGrid);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Model::create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Model::find($id);

        return view('avored-ecommerce::category.edit')->with('model', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\CategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Model::find($id);
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
        $category = Model::find($id);

        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
