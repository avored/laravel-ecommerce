<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Repository\Product;

class CategoryFieldsComposer
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
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = $this->productRepository->categoryModel()->getCategoryOptions('name', 'id');
        $view->with('categoryOptions', $categoryOptions);
    }
}
