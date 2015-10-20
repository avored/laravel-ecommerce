<?php

/*
Copyright (c) 2015, Purvesh
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

* Neither the name of Mage2 nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use Mage2\Core\Model\Category;
use Illuminate\Http\Request;
//use Mage2\Core\Model\Entity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id');
        //$entity = Entity::Category()->get()->first();

        return view('admin.category.create')->with('categories', $categories);
            //->with('entity', $entity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        //@tosdo Attribute Save
        $category = Category::create($request->all());

        if ($request->file('file') != "") {
            $category->image_path = $this->uploadImage($request->file('file'), $for = 'categories');
        }

        //Saving Attributes
        $attributes = $request->get('attribute');
        $this->saveAttribute($attributes, $category->id);


        $category->slug = str_slug($request->get('name'));
        //update File Path and Slug
        $category->save();

        return redirect('/admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);
        $categories = Category::lists('name', 'id');
        //$entity = Entity::Category()->get()->first();
        return view('admin.category.edit')
            ->with('categories', $categories)
            ->with('category', $category);
            //->with('entity', $entity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findorfail($id);
        $category->update($request->all());

        if ($request->file('file') != "") {
            $category->image_path = $this->uploadImage($request->file('file'), $for = 'categories');
        }

        //Saving Attributes
        $attributes = $request->get('attribute');
        $this->saveAttribute($attributes, $id);

        $category->slug = str_slug($request->get('name'));
        //update File Path and Slug
        $category->save();

        return redirect('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/admin/category');
    }

}
