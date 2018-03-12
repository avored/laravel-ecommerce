<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use AvoRed\Framework\Repository\Category;
use Illuminate\View\View;

class ProductFieldsComposer
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
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        $categoryOptions = $this->categoryRepository->model()->pluck('name', 'id');
        $storageOptions = [];//Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions',$storageOptions);

    }

}
