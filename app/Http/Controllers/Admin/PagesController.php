<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;

use Mage2\Core\Model\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pages = Page::simplePaginate(10);
        return view('admin.pages.index')->with('pages', $pages);
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CustomerGroupRequest $request
     * @return Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());
        return redirect("/admin/pages");
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
        $page = Page::findorfail($id);
        return view('admin.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CustomerGroupRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(PageRequest $request, $id)
    {

        $page = Page::findorfail($id);
        $page->update($request->all());

        return redirect("/admin/pages");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Page::destroy($id);
        return redirect('/admin/pages');
    }
}
