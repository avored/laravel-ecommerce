<?php
namespace AvoRed\RelatedProduct\ViewComposers;

use Illuminate\Support\Collection;
use AvoRed\RelatedProduct\Models\RelatedProduct;
use AvoRed\Framework\Tabs\Facades\Tabs;
use Illuminate\View\View;
use AvoRed\Framework\DataGrid\Facades\DataGrid;
use AvoRed\Framework\Database\Models\Product;

class RelatedProductComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        Tabs::add('related-product')
            ->setType('product')
            ->setLabel('Related Product')
            ->setViewpath('avored-related-product::related-product.product');

        $relatedProductIds = Collection::make([]);

        if (isset($view->product)) {

            $product = $view->product;
            $relatedProductIds = RelatedProduct::whereProductId($product->id)->get()->pluck('related_product_id');

            $productBuilders = Product::where('id', '!=', $product->id);


        } else {
            $productBuilders = Product::query();
        }

        $dataGrid = DataGrid::model($productBuilders)
            ->column('id', ['sortable' => true])
            ->linkColumn('related_checkbox', ['sortable' => false,'label' => ''], function ($model) use ($relatedProductIds) {
                if (in_array($model->id, $relatedProductIds->toArray())) {
                    return '<input type="checkbox" checked name="related[' . $model->id . ']" />';
                } else {
                    return '<input type="checkbox" name="related[' . $model->id . ']" />';
                }
            })
            ->column('name');

        $view->with('relatedDataGrid', $dataGrid);

    }

}
