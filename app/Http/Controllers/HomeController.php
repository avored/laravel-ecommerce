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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->productRepository->all()->random(8)->shuffle();
        return view('home')
            ->with('products', $products);
    }
}
