<?php

namespace App\Http\Composers;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Illuminate\View\View;

class NavComposer
{
    /**
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * home controller construct
     */
    public function __construct(
        CategoryModelInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all();
        $view->with('categories', $categories);
    }
}
