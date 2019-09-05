<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;

class HomeController extends Controller
{
    /**
     * Product Repository
     * \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * Construct for the home controller
     * @param \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    public function __construct(ProductModelInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Show the application dashboard.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $allProducts = $this->productRepository->getAllWithoutVaiation();
        if ($allProducts->count() <= 0) {
            $products = collect();
        } elseif ($allProducts->count() >= 8) {
            $products = $allProducts->random(8)->shuffle();
        } else {
            $products = $allProducts;
        }
        
        return view('home')
            ->with(compact('products'));
    }
}
