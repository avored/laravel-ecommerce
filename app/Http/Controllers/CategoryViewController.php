<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Repository\Category;
use AvoRed\Ecommerce\Models\Database\Product;
use AvoRed\Ecommerce\Models\Database\Attribute;

class CategoryViewController extends Controller
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
     *
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\Response
     *
     */
    public function view(Request $request, $slug)
    {
        $productsOnCategoryPage = 10; //Configuration::getConfiguration('avored_catalog_no_of_product_category_page');

        $category = $this->categoryRepository->model()->where('slug', '=', $slug)->get()->first();

        $collections = Product::getCollection()
            ->addCategoryFilter($category->id);


        foreach ($request->except(['page']) as $attributeIdentifier => $value) {
            $attribute = Attribute::where('identifier', '=', $attributeIdentifier)->first();

            $collections->addAttributeFilter($attribute->id, $value);
        }

        $categoryProducts = $collections->paginateCollection($productsOnCategoryPage);

        return view('catalog.category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $categoryProducts);

    }
}
