<?php
namespace Mage2\Ecommerce\Http\Controllers;

use Mage2\Ecommerce\Models\Database\Page;

class PageController extends Controller
{

    /**
     * Display the specified page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();

        return view('page.show')->with('page', $page);
    }
}
