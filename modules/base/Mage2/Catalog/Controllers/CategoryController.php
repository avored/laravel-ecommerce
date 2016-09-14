<?php

namespace Mage2\Catalog\Controllers;

use Illuminate\Support\Collection;

use Mage2\Catalog\Models\Category;
use Mage2\Catalog\Requests\CategoryRequest;
use Mage2\Framework\Http\Controllers\Controller;

class CategoryController extends Controller
{
  
    public function __construct(){
      
        parent::__construct();
    }
    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::orderBy('id','desc')->paginate(10);
        $categories = Category::paginate(10);
        return view('category.index')
                ->with('categories' , $categories)
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
        return view('category.create')
                ->with('categoryOptions', $categoryOptions)
            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->merge(['website_id' => $this->websiteId]);

        Category::create($request->all());

        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryOptions = $this->_getCategoryOptions();
        $category = Category::findorfail($id);
        return view('category.edit')
            ->with('category', $category)
            ->with('categoryOptions', $categoryOptions)
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->route('admin.category.index');
    }

    private function _getCategoryOptions() {
        $options =  Collection::make(['0' => 'please select'])->toArray() +  Category::pluck('name','id')->toArray();

        return $options;
    }
}
