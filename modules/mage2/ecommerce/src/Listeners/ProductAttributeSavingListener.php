<?php

namespace Mage2\Attribute\Listeners;


use Mage2\Attribute\Models\Attribute;
use Mage2\Attribute\Models\ProductTextTypeVariation;
use Mage2\Attribute\Models\ProductVarcharValue;
use Mage2\Attribute\Models\ProductVariation;
use Mage2\Framework\Database\Models\ProductImage;
use Mage2\Framework\Database\Models\Product;


class ProductAttributeSavingListener
{
    /**
     * Handle the event.
     *
     * @param  mag2 .user.registered  $event
     * @return void
     */
    public function handle($event)
    {

        $product = $event->product;
        $request = $event->request;

        /**
        $this->saveProductAttributeVariation($product, $request);
        $attributes = $request->get('modules');

        ProductVarcharValue::whereProductId($product->id)->delete();

        foreach($attributes['attributes'] as $identifier => $value) {

            if(!empty($value)) {
                $productAttribute = Attribute::whereIdentifier($identifier)->first();
                ProductVarcharValue::create([
                    'product_id' => $product->id,
                    'product_attribute_id' => $productAttribute->id,
                    'value' => $value
                ]);
            }
        }
         */

    }

    /**
     * Save Product Attribute with variations
     * @param \Mage2\Framework\Database\Models\Product $product
     * @param \Mage2\Framework\Http\Requests\ProductRequest $request
     * @return $this
     */
    public function saveProductAttributeVariation($product, $request)
    {

        $variations = $request->get('variations');

        //dd($variations);
        if ($variations !== NULL && count($variations) > 0) {
            //@todo update image to hasvariation = true
            $product->update(['has_variation' => 1]);

            $existingIds = array_flip($product->productVariations->pluck('id')->toArray());

            foreach ($variations as $attributeId => $attribute) {
                foreach ($attribute as $fieldType => $variationFields) {

                    if($fieldType == "text") {
                        //@todo Product Update needs to do it again.
                        //Create Should Work
                        $productAttributeId = $variationFields['attribute_id'];
                        ProductTextTypeVariation::create(['product_attribute_id' => $productAttributeId, 'product_id' => $product->id]);

                    }
                    if($fieldType == "dropdown") {

                        foreach ($variationFields as $dropdownId => $fieldValue ) {

                            if (isset($fieldValue['id']) && $fieldValue['id'] > 0) {
                                unset($existingIds [$fieldValue['id']]);

                                $variation = ProductVariation::findorfail($fieldValue['id']);
                                $subProduct = $variation->subProduct;
                                $subProduct->update($fieldValue);

                                $subProduct->prices()->get()->first()->update(['price' => $fieldValue['price']]);

                                if ($imageArray = $request->file('attribute') &&
                                    isset($request->file('attribute')[$attributeId]) &&
                                    isset($request->file('attribute')[$attributeId][$dropdownId])
                                ) {

                                    //todo delete image file as well....
                                    $image = $request->file('attribute')[$attributeId][$dropdownId]['image'];

                                    $attributeImagePath = $this->_uploadImage($image);

                                    ProductImage::where('product_id', '=', $subProduct->id)->delete();
                                    ProductImage::create(['path' => $attributeImagePath, 'product_id' => $subProduct->id]);
                                }


                            } else {

                                $fieldValue['slug'] = $fieldValue['sku'];
                                $subProduct = Product::create($fieldValue);

                                $subProduct->prices()->create(['price' => $fieldValue['price']]);

                                ProductVariation::create(['sub_product_id' => $subProduct->id,
                                    'product_attribute_id' => $attributeId,
                                    'attribute_dropdown_option_id' => $dropdownId,
                                    'product_id' => $product->id,
                                    'price' => $fieldValue['price']
                                ]);

                                if ($imageArray = $request->file('attribute') &&
                                    isset($request->file('attribute')[$attributeId]) &&
                                    isset($request->file('attribute')[$attributeId][$dropdownId])
                                ) {
                                    $image = $imageArray[$attributeId][$dropdownId]['image'];
                                    $attributeImagePath = $this->_uploadImage($image);

                                    ProductImage::where('product_id', '=', $subProduct->id)->delete();

                                    ProductImage::create(['path' => $attributeImagePath, 'product_id' => $subProduct->id]);
                                }
                            }
                        }

                    } // END IF DROPDOWN FIELD TYPE

                }
            }

            if (count($existingIds) > 0) {
                foreach (array_flip($existingIds) as $id) {
                    ProductVariation::destroy($id);
                }
            }

        } else {
            //only needed when remove all attribute using remove icon during edit product
            $product->update(['has_variation' => 0]);
        }

        return $this;
    }


    private function _uploadImage($image)
    {
        $destinationPath = 'uploads/catalog/images/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))) . '/';
        $image->move($destinationPath . $relativePath, $image->getClientOriginalName());

        return $relativePath . $image->getClientOriginalName();
    }

}
