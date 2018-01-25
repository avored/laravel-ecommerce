<?php
namespace Mage2\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Collection;
use Mage2\Ecommerce\Models\Database\Product;
use Mage2\Ecommerce\Tabs\Facade as Tabs;
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
            ->setViewpath('mage2-ecommerce::related-product.related-product-view');

        $product = $view->product;

        $relatedProducts = $product->relatedProducts()->paginate(4);

        foreach($relatedProducts as $relatedProductModel) {

            $product = Product::find($relatedProductModel->related_product_id);
            $this->relatedProducts->push($product);

        }
        $view->with('relatedProducts', $this->relatedProducts);
    }

}
