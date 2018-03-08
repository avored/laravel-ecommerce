<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Ecommerce\Models\Database\Category;
use AvoRed\Ecommerce\Models\Database\Product;
use AvoRed\Ecommerce\Models\Database\Attribute;

class CategoryViewController extends Controller
{

    public function view(Request $request, $slug)
    {
        $productsOnCategoryPage = 10; //Configuration::getConfiguration('avored_catalog_no_of_product_category_page');



        $category = Category::where('slug', '=', $slug)->get()->first();

        $collections = Product::getCollection()
            ->addCategoryFilter($category->id);


        foreach ($request->except(['page']) as $attributeIdentifier => $value) {
            $attribute = Attribute::where('identifier', '=', $attributeIdentifier)->first();

            $collections->addAttributeFilter($attribute->id, $value);
        }

        $categoryProducts = $collections->paginateCollection($productsOnCategoryPage);
        
        //$categoryProducts->withPath(route('category.view', [$slug]))->appends($request->except(['page']));

        return view('catalog.category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $categoryProducts);

    }
}
