<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Database\Category;

class CategoryViewController extends Controller
{

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

        $category       = Category::whereSlug($slug)->first();
        $catProducts    = $category->getCategoryProductWithFilter($request->except(['page']));
        $products       = $category->paginateProducts($catProducts, $productsOnCategoryPage);

        return view('category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $products);

    }
}
