<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Models\Database\Category as Model;
use AvoRed\Ecommerce\DataGrid\Category;
use AvoRed\Ecommerce\Http\Requests\CategoryRequest;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class CategoryController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\CategoryRepository
    */
    protected $repository;

    public function __construct(CategoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryGrid = new Category($this->repository->query());

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
        $this->repository->create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $category)
    {
        return view('avored-ecommerce::category.edit')->with('model', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\CategoryRequest $request
     * @param \AvoRed\Framework\Models\Database\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Model $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $category)
    {
        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
