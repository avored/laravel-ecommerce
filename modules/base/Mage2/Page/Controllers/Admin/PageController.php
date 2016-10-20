<?php

namespace Mage2\Page\Controllers\Admin;

use Mage2\Page\Requests\PageRequest;
use Illuminate\Support\Facades\Auth;
use Mage2\Page\Models\Page;
use Mage2\Framework\Http\Controllers\Controller;



class PageController extends Controller {

   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pages = Page::paginate(10);
        return view("admin.page.index")
                        ->with('pages', $pages)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view("admin.page.create")

        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mage2\Page\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request) {
        Page::create($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $page = Page::findorfail($id);
        return view("admin.page.edit")
                        ->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Mage2\Page\Requests\Page  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id) {
        $page = Page::findorfail($id);
        $page->update($request->all());
        
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Page::destroy($id);
        return redirect()->route('admin.page.index');
    }

}
