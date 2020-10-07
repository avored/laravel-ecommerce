<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
     * Product Repository
     * \AvoRed\Wishlist\Database\Repository\WishlistRepository $wishlistRepository.
     */
    protected $wishlistRepository;

    /**
     * Construct for the home controller.
     * @param \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     * @param \AvoRed\Framework\Database\Repository\PageRepository $pageRepository
     * @param \AvoRed\Wishlist\Database\Repository\WishlistRepository $wishlistRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        PageModelInterface $pageRepository,
        WishlistModelInterface $wishlistRepository
    ) {
        $this->productRepository = $productRepository;
        $this->pageRepository = $pageRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $page = $this->pageRepository->findBySlug('home-page');
        $allProducts = $this->productRepository->getAllWithoutVaiation();
        $heroProduct = null;
        if ($allProducts->count() > 0) {
            $heroProduct = $allProducts->load('mainImage')->random(1)->first();
        }
        $products = collect();
        
        if ($allProducts->count() > 0) {
            $products = $allProducts->load('mainImage');
        } 
        if ($allProducts->count() >= 8) {
            $products = $allProducts->load('mainImage')->random(8)->shuffle();
        }

        return view('home')
            ->with('heroProduct', $heroProduct)
            ->with('products', $products)
            ->with('page', $page);
    }
}
