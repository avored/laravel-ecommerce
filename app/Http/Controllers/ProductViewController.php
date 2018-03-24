<?php
namespace App\Http\Controllers;

use AvoRed\Framework\Repository\Product;

class ProductViewController extends Controller
{

    /**
     * AvoRed Attribute Repository
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $productRepository;

    /**
     * Cart Controller constructor to Set AvoRed Product Repository Property.
     *
     * @param \AvoRed\Framework\Repository\Product $repository
     * @return void
     */
    public function __construct(Product $repository)
    {
        parent::__construct();
        $this->productRepository = $repository;
    }

    public function view($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $view = view('catalog.product.view')->with('product', $product);

        $title          = (!empty($product->meta_title)) ? $product->meta_title : $product->name;
        $description    = (!empty($product->meta_description)) ? $product->meta_description : substr($product->description, 0, 255);

        $view->with('title', $title);
        $view->with('description', $description);

        return $view;
    }

}
