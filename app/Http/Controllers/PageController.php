<?php
namespace App\Http\Controllers;

use AvoRed\Ecommerce\Repository\Page;

class PageController extends Controller
{


    /**
     * AvoRed Config Repository
     *
     * @var \AvoRed\Ecommerce\Repository\Page
     */
    protected $pageRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\Page $repository

     * @return void
     */
    public function __construct(Page $repository)
    {
        $this->pageRepository   = $repository;
    }

    /**
     * Display the specified page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = $this->pageRepository->findPageBySlug($slug);

        return view('page.show')->with('page', $page);
    }
}
