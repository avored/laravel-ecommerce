<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * home controller construct
     */
    public function __construct()
    {
        // $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        // $category = $this->categoryRepository->findBySlug($slug);
        // $categories = $this->categoryRepository->all();
        return view('cart.show');
    }
}
