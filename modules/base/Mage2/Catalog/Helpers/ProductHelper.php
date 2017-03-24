<?php

namespace Mage2\Catalog\Helpers;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductImage;
use Mage2\Catalog\Models\ProductPrice;
use Mage2\Catalog\Models\ProductVarcharValue;
use Mage2\Catalog\Models\ProductVariation;
use Mage2\Catalog\Models\RelatedProduct;
use Mage2\Catalog\Requests\ProductRequest;
use Illuminate\Http\UploadedFile;
use Mage2\Catalog\Models\Product;


class ProductHelper
{


    /**
     * Insert or update product into Product table.
     *
     * @param type $product
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
    public function saveProductExtraAttribute($product, ProductRequest $request)
    {
        $extraAttributes = $request->get('modules');

        foreach($extraAttributes['attributes'] as $identifier => $value) {
            $attribute  = ProductAttribute::where('identifier' , '=', $identifier)->first();


            $productVarcharValue = ProductVarcharValue::where('product_id','=', $product->id)->where('product_attribute_id','=', $attribute->id)->first();

            if(null ===  $productVarcharValue) {
                ProductVarcharValue::create([
                    'product_id' => $product->id,
                    'product_attribute_id' => $attribute->id,
                    'value' => $value
                ]);
            } else {
                $productVarcharValue->update(['value' => $value]);
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
        $attributes = $request->get('attribute');

        if ($attributes !== NULL && count($attributes) > 0) {
            //@todo update image to hasvariation = true
            $product->update(['has_variation' => 1]);


            $existingIds = array_flip( $product->productVariations->pluck('id')->toArray());

            foreach ($attributes as $attributeId => $attribute) {

                foreach ($attribute as $dropdownId => $fieldValue) {

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
            }

            if(count($existingIds)>0) {
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


    private function _uploadImage(UploadedFile $image)
    {


        $destinationPath = 'uploads/catalog/images/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))) . '/';
        $image->move($destinationPath . $relativePath, $image->getClientOriginalName());

        return $relativePath . $image->getClientOriginalName();
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
        if (NULL === $request->get('image')) {
            return $this;
        }

        $exitingIds = $product->images()->get()->pluck('id')->toArray();

        foreach ($request->get('image') as $key => $path) {

            if (is_int($key)) {
                if (($findKey = array_search($key, $exitingIds)) !== false) {
                    unset($exitingIds[$findKey]);
                }
                continue;
            }

            ProductImage::create(['path' => $path[0], 'product_id' => $product->id]);
        }

        if (count($exitingIds) > 0) {

            ProductImage::destroy($exitingIds);
        }

        return $this;


    }

    /**
     *
     * @param \Mage2\Catalog\Models\Product $product
     * @param array $data
     * @return $this
     */
    public function saveProductPrice($product, $data)
    {

        if ($product->prices()->get()->count() > 0) {
            $product->prices()->get()->first()->update(['price' => $data['price']]);
        } else {
            $product->prices()->create(['price' => $data['price']]);
        }
        return $this;
    }


}
