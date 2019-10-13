<?php

namespace App\Http\Controllers;

use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Wishlist\Database\Contracts\WishlistModelInterface;

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
        $wishlists = $this->wishlistRepository->userWishlists();
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
            ->with(compact('products', 'page', 'wishlists'));
    }
}
