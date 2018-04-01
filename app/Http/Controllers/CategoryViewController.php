<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Repository\Product;

class CategoryViewController extends Controller
{
    /**
     * AvoRed Attribute Repository
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $productRepository;

    public function __construct(Product $repository)
    {
        parent::__construct();
        $this->productRepository   = $repository;
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

        $category = $this->productRepository->findCategoryBySlug($slug);
        $categoryProducts = $category->products()
                                ->whereStatus(1)->get();

        foreach ($request->except(['page']) as $type => $arrays) {

            if('property' == $type) {

                foreach ($arrays as $identifier => $value) {

                    $attribute = $this->productRepository->propertyModel()->where('identifier', '=', $identifier)->first();

                    if(null !== $attribute) {

                        $attributeId  = $attribute->id;

                        $categoryProducts = $categoryProducts->filter(function ($product) use ($attributeId, $value) {

                            foreach ($product->getProductAllProperties() as $productAttribute) {

                                if ($productAttribute->property_id == $attributeId && $productAttribute->value == $value) {
                                    return $product;
                                }
                            }
                        });
                    }
                }
            }

            if('attribute' == $type) {

                $attribute = $this->productRepository->attributeModel()->where('identifier', '=', $identifier)->first();

                if (null !== $attribute) {
                    $categoryProducts = $this->productRepository->model()->setCollection($categoryProducts)->addAttributeFilter($attribute->id, $value);
                }

            }
        }



        $products = $this->productRepository->model()->productPaginate($categoryProducts, $productsOnCategoryPage);
        //dd($categoryProducts);

        //$categoryProducts = $collections->paginateCollection($productsOnCategoryPage);

        //dd($products);


        return view('catalog.category.view')
            ->with('category', $category)
            ->with('params', $request->all())
            ->with('products', $products);

    }
}
