<?php

namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class CategoryFieldsComposer
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\CategoryRepository
    */
    protected $repository;

    public function __construct(CategoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = $this->repository->options();
        $view->with('categoryOptions', $categoryOptions);
    }
}
