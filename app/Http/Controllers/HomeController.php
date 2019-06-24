<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class HomeController extends Controller
{

    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * home controller construct
     */
    public function __construct(
        CategoryModelInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();
        return view('home')
            ->with('categories', $categories);
    }
}
