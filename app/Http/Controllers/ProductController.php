<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;

class ProductController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * home controller construct
     */
    public function __construct(
        ProductModelInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }
    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($slug)
    {
        $product = $this->productRepository->findBySlug($slug);
        $product->images;

        return view('product.show')
            ->with(compact('product'));
    }
}
