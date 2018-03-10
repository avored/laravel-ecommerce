<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Collection;
use AvoRed\Ecommerce\Models\Database\Product;
use AvoRed\Framework\Tabs\Facade as Tabs;
use Illuminate\View\View;

class RelatedProductViewComposer
{
    public $relatedProducts;

    public function __construct() {
        $this->relatedProducts = Collection::make([]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        Tabs::add('related-product')
            ->setType('product-view')
            ->setLabel('Related Product')
            ->setViewpath('avored-ecommerce::related-product.related-product-view');

        $product = $view->product;

        $relatedProducts = $product->relatedProducts()->paginate(4);

        foreach($relatedProducts as $relatedProductModel) {

            $product = Product::find($relatedProductModel->related_product_id);
            $this->relatedProducts->push($product);

        }
        $view->with('relatedProducts', $this->relatedProducts);
    }

}
