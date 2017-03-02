<?php

namespace Mage2\Catalog\Helpers;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductImage;
use Mage2\Catalog\Models\ProductPrice;
use Mage2\Catalog\Models\ProductVariation;
use Mage2\Catalog\Models\RelatedProduct;
use Mage2\Catalog\Requests\ProductRequest;


class ProductHelper
{


    /**
     * Insert or update product into Product table.
     *
     * @param type                                  $product
     * @param \Mage2\Catalog\Helpers\ProductRequest $request
     */
    public function saveProduct($product, ProductRequest $request)
    {
        $product->update($request->all());

        return $this;
        //Sync Website i was using it .....????
    }

    /**
     *
     * Save Related Product into related table
     *
     * @param \Mage2\Catalog\Models\Product $product
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     * @return $this
     */
    public function saveRelatedProducts($product, ProductRequest $request)
    {
        if (count($request->get('related_products')) > 0) {
            $relatedProducts = [];
            RelatedProduct::where('product_id', '=', $product->id)->delete();
            foreach ($request->get('related_products') as $relatedId) {
                $relatedProducts = ['product_id' => $product->id, 'related_product_id' => $relatedId];
                RelatedProduct::create($relatedProducts);
            }
        }
    }

    /**
     *
     *  Save Product Category
     * @param \Mage2\Catalog\Models\Product $product
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     * @return $this
     */
    public function saveCategory($product, ProductRequest $request)
    {
        if (count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
    }

    /**
     * Save Product Attribute with variations
     * @param \Mage2\Catalog\Models\Product $product
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     * @return $this
     */
    public function saveProductAttribute($product, ProductRequest $request)
    {

        $attributes  = $request->get('attribute');


        if($attributes !== NULL && count($attributes) >0 ) {
            //@todo update image to hasvariation = true
            $product->update(['has_variation' => 1]);

            foreach ($attributes as $attributeId => $attribute) {


                foreach($attribute as $dropdownId => $fieldValue) {

                    //@todo Upload Image Here then add
                    $data = ['product_attribute_id' => $attributeId,'attribute_dropdown_option_id' => $dropdownId, 'product_id' => $product->id] + $fieldValue;

                    if(isset($fieldValue['id']) && $fieldValue['id'] > 0) {
                        $variation = ProductVariation::findorfail($fieldValue['id']);
                        $variation->update($data);

                    } else {
                        ProductVariation::create($data);
                    }



                }
            }
        }
        return $this;
    }


    /**
     *
     * @param \Mage2\Catalog\Models\Product $product
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     * @return $this
     */
    public function saveProductImages($product, ProductRequest $request)
    {

        $exitingIds = [];
        if(NULL === $request->get('image')) {
            return $this;
        }

        $exitingIds = $product->images()->get()->pluck('id')->toArray();

        foreach ($request->get('image') as $key => $path ) {



            if(is_int($key)) {
                if(($findKey = array_search($key, $exitingIds)) !== false) {
                    unset($exitingIds[$findKey]);
                }

                continue;
            }

            ProductImage::create(['path' => $path[0], 'product_id' => $product->id]);

        }

        if(count($exitingIds) >0 ) {

            ProductImage::destroy($exitingIds);
        }

        return $this;


    }

    /**
     *
     * @param \Mage2\Catalog\Models\Product $product
     * @param \Mage2\Catalog\Requests\ProductRequest $request
     * @return $this
     */
    public function saveProductPrice($product, ProductRequest $request) {

        //dd();
        if($product->prices()->get()->count() > 0) {
            $product->prices()->get()->first()->update(['price' => $request->get('price')]);
        } else {
            $product->prices()->create(['price' => $request->get('price')]);
        }
        //$price  = ProductPrice::create(['price' => $request->get('price'), 'product_id' => $product->id]);

        return $this;
    }


}
