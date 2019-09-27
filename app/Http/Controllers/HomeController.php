<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;

class HomeController extends Controller
{
    /**
     * Product Repository
     * \AvoRed\Framework\Database\Repository\ProductRepository $productRepository.
     */
    protected $productRepository;
    /**
     * Product Repository
     * \AvoRed\Framework\Database\Repository\PageRepository $pageRepository.
     */
    protected $pageRepository;

    /**
     * Construct for the home controller.
     * @param \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     * @param \AvoRed\Framework\Database\Repository\PageRepository $pageRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        PageModelInterface $pageRepository
    ) {
        $this->productRepository = $productRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page = $this->pageRepository->findBySlug('home-page');
        $allProducts = $this->productRepository->getAllWithoutVaiation();
        if ($allProducts->count() <= 0) {
            $products = collect();
        } elseif ($allProducts->count() >= 8) {
            $products = $allProducts->random(8)->shuffle();
        } else {
            $products = $allProducts;
        }

        return view('home')
            ->with(compact('products', 'page'));
    }
}
