<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Requests;

class PageController extends Controller
{
    public function index() {
        $pages = Page::paginate(10);
        return view('page.index')->with('pages', $pages);
    }
    
    public function create() {
        return view('page.create');
    }
}
