<?php
namespace AvoRed\Ecommerce\Http\ViewComposers;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use AvoRed\Ecommerce\Tabs\Facade as Tabs;

class ProductSpecificationComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        //Tabs::add('product-attribute')
        //    ->setType('product-view')
        //    ->setLabel('Specification')
        //    ->setViewpath('attribute.product-specification-tab');


        //$productAttributes = Collection::make(['' => 'Please Select'])->union(ProductAttribute::all()->pluck('title', 'id'));

        //$productAttributes  = [];//ProductAttribute::whereUseAs('SPECIFICATION')->get();

        //$view->with('productAttributes', $productAttributes)
            ;
    }

}
