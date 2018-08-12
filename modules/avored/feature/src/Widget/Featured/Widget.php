<?php

namespace AvoRed\Featured\Widget\Featured;

use AvoRed\Framework\Models\Database\ProductPropertyIntegerValue;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;
use Illuminate\Support\Collection;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class Widget implements WidgetContract
{



    /**
     *
     * Widget View Path
     *
     * @var string $view
     */

    protected $view = "avored-featured::widget.index";


    /**
     *
     * Widget Label
     *
     * @var string $view
     */

    protected $label = 'Featured List';


    /**
     *
     * Widget Type
     *
     * @var string $view
     */

    protected $type = "cms";

    /**
     *
     * Widget unique identifier
     *
     * @var string $identifier
     */
    protected $identifier = "avored-featured";


    public function view()
    {
        return $this->view;
    }

    /*
     * Widget unique identifier
     *
     */
    public function identifier()
    {

        return $this->identifier;
    }

    /*
    * Widget unique identifier
    *
    */
    public function label()
    {

        return $this->label;
    }

    /*
    * Widget unique identifier
    *
    */
    public function type()
    {

        return $this->type;
    }

    /**
     * View Required Parameters
     *
     * @return array
     */
    public function with()
    {

        return [];

    }

    public function render() {

        
        $featuredProperty = Property::whereIdentifier('avored-is-featured')->first();

        $featuredProductIds = ProductPropertyIntegerValue::wherePropertyId($featuredProperty->id)->paginate(4)->pluck('product_id');

        $products = new Collection();
        $productRepository = app(ProductInterface::class);
        foreach ($featuredProductIds as $featuredProductId) {

            $products->push($productRepository->find($featuredProductId));
        }

       // $products = $productRepository->model()->paginate(4);
        return view($this->view())->with('products' , $products);
    }

}