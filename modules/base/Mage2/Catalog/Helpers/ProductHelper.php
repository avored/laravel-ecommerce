<?php

namespace Mage2\Catalog\Helpers;

use Illuminate\Support\Facades\Session;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Catalog\Models\RelatedProduct;
use Mage2\Catalog\Requests\ProductRequest;
use Mage2\Framework\Support\Helper;

class ProductHelper extends Helper
{
    public $websiteId;
    public $defaultWebsiteId;
    public $isDefaultWebsite;

    //public $theme;

    public function __construct()
    {
        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
    }

    /**
     * Insert or update product into pivot table.
     *
     * @param type                                  $product
     * @param \Mage2\Catalog\Helpers\ProductRequest $request
     */
    public function saveProduct($product, ProductRequest $request)
    {
        if (count($request->get('website_id')) > 0) {
            $product->websites()->sync($request->get('website_id'));
        }
    }

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

    public function saveCategory($product, ProductRequest $request)
    {
        if (count($request->get('category_id')) > 0) {
            $product->categories()->sync($request->get('category_id'));
        }
    }

    public function saveProductAttribute($product, ProductRequest $request)
    {
        $productAttributes = ProductAttribute::all();

        foreach ($productAttributes as $productAttribute) {
            $identifier = $productAttribute->identifier;
            if (null == $request->get($identifier)) {
                continue;
            }
            if ($product->$identifier == $request->get($identifier)) {
                continue;
            }


            switch ($productAttribute->type) {
                case 'VARCHAR':
                    $value = $request->get($identifier);
                    $this->_saveProductVarcharValue($product, $identifier, $productAttribute, $value);
                    break;

                case 'INTEGER':
                    $value = $request->get($identifier);
                    $this->_saveProductIntegerValue($product, $identifier, $productAttribute, $value);
                    break;

                case 'FLOAT':
                    $value = $request->get($identifier);
                    $this->_saveProductFloatValue($product, $identifier, $productAttribute, $value);
                    break;

                case 'DATETIME':
                    $value = $request->get($identifier);
                    $this->_saveProductDatetimeValue($product, $identifier, $productAttribute, $value);
                    break;

                case 'TEXT':
                    $value = $request->get($identifier);
                    $this->_saveProductTextValue($product, $identifier, $productAttribute, $value);
                    break;

                default:
                    break;
            }
        }

        return true;
    }

    public function saveProductImages($product, ProductRequest $request)
    {
        $productAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $productAttribute->productVarcharValues()->where('product_id', '=', $product->id)->delete();



        if (count($request->get('image')) <= 0) {
            return true;
        }

        foreach ($request->get('image') as $image) {
            if (is_int($image)) {
                continue;
            }

            $productAttribute->productVarcharValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $image,
            ]);
        }
    }

    private function _saveProductVarcharValue($product, $identifier, $productAttribute, $value)
    {
        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productVarcharValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();

            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (null === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productVarcharValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $value,
            ]);
        } else {
            $productAttribute->productVarcharValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value'      => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductIntegerValue($product, $identifier, $productAttribute, $value)
    {
        $createNewRecord = false;

        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productIntegerValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();

            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (null === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productIntegerValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $value,
            ]);
        } else {
            $productAttribute->productIntegerValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value'      => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductTextValue($product, $identifier, $productAttribute, $value)
    {
        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productTextValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (null === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productTextValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $value,
            ]);
        } else {
            $productAttribute->productTextValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value'      => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductFloatValue($product, $identifier, $productAttribute, $value)
    {
        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productFloatValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (null === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productFloatValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $value,
            ]);
        } else {
            $productAttribute->productFloatValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value'      => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }

    private function _saveProductDatetimeValue($product, $identifier, $productAttribute, $value)
    {
        $createNewRecord = false;
        if ($this->isDefaultWebsite == false) {
            $attributeValue = $productAttribute
                            ->productDatetimeValues()
                            ->where('product_id', '=', $product->id)
                            ->where('website_id', '=', $this->websiteId)
                            ->get()->first();
            if (null === $attributeValue) {
                $createNewRecord = true;
            }
        }

        if (null === $product->$identifier || $createNewRecord == true) {
            $productAttribute->productDatetimeValues()->create([
                'product_id' => $product->id,
                'website_id' => $this->websiteId,
                'value'      => $value,
            ]);
        } else {
            $productAttribute->productDatetimeValues()
                    ->where('product_id', '=', $product->id)->get()->first()
                    ->update([
                        'value'      => $value,
                        'website_id' => $this->websiteId,
            ]);
        }
    }
}
