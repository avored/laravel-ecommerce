<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Repository\Product;

class ProductFieldsComposer
{
    /*
    * AvoRed Framework Category Repository
    *
    * @var \AvoRed\Framework\Repository\Product
    */
    public $productRepository;

    public function __construct(Product $repository)
    {
        $this->productRepository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = $this->productRepository->categoryModel()->all()->pluck('name', 'id');
        $storageOptions = []; //Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions', $storageOptions);
    }
}
