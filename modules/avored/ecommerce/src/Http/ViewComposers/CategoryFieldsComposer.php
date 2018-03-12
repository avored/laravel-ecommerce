<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Repository\Category;

class CategoryFieldsComposer
{
    /*
     * AvoRed Framework Category Repository
     *
     * @var \AvoRed\Framework\Repository\Category
     */
    public $categoryRepository;

    public function __construct(Category $repository)
    {
        $this->categoryRepository=  $repository;

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categoryOptions = $this->categoryRepository->model()->getCategoryOptions('name', 'id');
        $view->with('categoryOptions', $categoryOptions);
    }

}
