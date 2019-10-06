<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;

class ProductController extends Controller
{
    /**
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;
    /**
     * @var \AvoRed\Review\Database\Repository\ProductReviewRepository
     */
    protected $productReviewRepository;

    /**
     * home controller construct.
     */
    public function __construct(
        ProductModelInterface $productRepository,
        ProductReviewModelInterface $productReviewRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productReviewRepository = $productReviewRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($slug)
    {
        $product = $this->productRepository->findBySlug($slug);
        $reviews = $this->productReviewRepository->getAllReviewsByProductId($product->id);
        $product->images;

        return view('product.show')
            ->with(compact('product', 'reviews'));
    }
}
