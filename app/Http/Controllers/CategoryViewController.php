<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Database\Category;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class CategoryViewController extends Controller
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
     *
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     *
     */
    public function view(Request $request, $slug)
    {
        $productsOnCategoryPage = 9;

        $category = $this->repository->findByKey($slug);

        $catProducts = $category->getCategoryProductWithFilter($request->except(['page']));
        $products = $category->paginateProducts($catProducts, $productsOnCategoryPage);

        return view('category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $products);
    }
}
