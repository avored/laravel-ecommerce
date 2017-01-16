<?php

namespace Mage2\Catalog\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\Install\Models\Website;
use Mage2\Catalog\Models\Review;
use Illuminate\Support\Facades\Cache;

class Product extends BaseModel {

    protected $fillable = [];
    protected $websiteId;
    protected $defaultWebsiteId;
    protected $isDefaultWebsite;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->websiteId = Session::get('website_id');
        $this->defaultWebsiteId = Session::get('default_website_id');
        $this->isDefaultWebsite = Session::get('is_default_website');
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function websites() {
        return $this->belongsToMany(Website::class);
    }

    public function relatedProducts() {
        return $this->hasMany(RelatedProduct::class);
    }

    public function orders() {
        return $this->hasMany(Order::class, 'product_order');
    }

    public function getProductImages($first = false) {

        //$cacheKey = get_class($this) . "_" . __METHOD__;
        //if (Cache::has($cacheKey)) {
        //    $attributeValue = Cache::get($cacheKey);
        //} else {

        $productAttribute = ProductAttribute::where('identifier', '=', 'image')->get()->first();
        $attributeValue = $productAttribute
                        ->productVarcharValues()
                        ->where('product_id', '=', $this->attributes['id'])
                        ->where('website_id', '=', $this->websiteId)->get();
        //}

        if (true == $first) {
            return $attributeValue->first();
        }

        //Cache::put($cacheKey, $attributeValue, $minute = 100);

        return $attributeValue;
    }

    public function getReviews() {
        return $this->reviews()->where('status', '=', 'ENABLED')->get();
    }

    public function getTaxAmount() {
        $taxPercentage = Configuration::getConfiguration('mage2_tax_class_percentage_of_tax');
        $price = $this->price;

        $taxAmount = ($taxPercentage * $price / 100);

        return $taxAmount;
    }

    /*
     *
     * @return float $value
     */

    public function getPrice() {
        $key = 'price';
        $productAttribute = ProductAttribute::where('identifier', '=', $key)->get()->first();
        $value = $this->_getProductFloatValue($productAttribute);

        if (null === $value) {
            return NULL;
        }
        /*
         * @todo fix bug because during display its fine but
         * when it times to do process data into mysql
         *  it will generate error because of 1,099.99 not decimal(because of comma , )
         */
        return $value;
        //return number_format($value,2);
    }

    public function getAttribute($key) {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        //
        if ($key == 'website_id') {
            $websites = $this->websites()->get()->pluck('id');

            return $websites->all();
        }

        if ($key == 'price') {
            return $this->getPrice();
        }

        //
        if ($key == 'category_id') {
            $categories = $this->categories()->get()->pluck('id');

            return $categories->all();
        }

        if ($key == 'reviews') {
            return $this->reviews()->get();
        }

        $value = null;

        //$cacheKey = ProductAttribute::class . "_" . $key;
        //if(Cache::has($cacheKey)) {
        //    $productAttribute = Cache::get($cacheKey);
        //} else {
        $productAttribute = ProductAttribute::where('identifier', '=', $key)->get()->first();
        //Cache::put($cacheKey , $productAttribute, $minute = 100);
        //}



        if (null == $productAttribute) {
            return;
        }

        switch ($productAttribute->type) {

            case 'VARCHAR':

                $value = $this->_getProductVarcharValue($productAttribute);
                break;

            case 'INTEGER':

                $value = $this->_getProductIntegerValue($productAttribute);
                break;

            case 'FLOAT':
                $value = $this->_getProductFloatValue($productAttribute);
                break;

            case 'TEXT':
                $value = $this->_getProductTextValue($productAttribute);
                break;

            case 'DATETIME':
                $value = $this->_getProductdatetimeValue($productAttribute);
                break;
            default:
                break;
        }

        return $value;
    }

    private function _getProductVarcharValue($productAttribute) {

        //$cacheKey = get_class($this) . "_" . $this->attributes['id']  ."_" . $this->websiteId . "_" . $productAttribute->title;
        //if (Cache::has($cacheKey)) {
            //$value = Cache::get($cacheKey);
        //} else {

            $value = null;
            $attributeValue = null;

            if (!$this->isDefaultWebsite) {
                $attributeValue = $productAttribute
                                        ->productVarcharValues()
                                        ->where('product_id', '=', $this->attributes['id'])
                                        ->where('website_id', '=', $this->websiteId)
                                        ->get()->first();
            }

            if (null === $attributeValue) {
                $attributeValue = $productAttribute
                                        ->productVarcharValues()
                                        ->where('product_id', '=', $this->attributes['id'])
                                        ->where('website_id', '=', $this->defaultWebsiteId)
                                        ->get()->first();
            }

            if (isset($attributeValue->value)) {
                $value = $attributeValue->value;
                //Cache::put($cacheKey, $value, $minute = 100);
            }
        //}
        

        return $value;
    }

    private function _getProductIntegerValue($productAttribute) {
        $value = null;
        $attributeValue = null;

        $cacheKey = get_class($this) . "_" . $this->attributes['id']  . "_" .  $this->websiteId . "_" . $productAttribute->title;
        if (Cache::has($cacheKey)) {
            $value = Cache::get($cacheKey);
        } else {


        if (!$this->isDefaultWebsite) {
            $attributeValue = $productAttribute
                                    ->productIntegerValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->websiteId)
                                    ->get()->first();
        }

        if (null === $attributeValue) {
            $attributeValue = $productAttribute
                                    ->productIntegerValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->defaultWebsiteId)
                                    ->get()->first();
        }

        if (isset($attributeValue->value)) {
            $value = $attributeValue->value;
            Cache::put($cacheKey, $value, $minute = 100);
        }

        }
        return $value;
    }

    private function _getProductFloatValue($productAttribute) {
        $value = null;
        $attributeValue = null;


        $cacheKey = get_class($this) . "_" . $this->attributes['id'] . "_" .  $this->websiteId . "_" . $productAttribute->title;
        if (Cache::has($cacheKey)) {
            $value = Cache::get($cacheKey);
        } else {
        if (!$this->isDefaultWebsite) {
            $attributeValue = $productAttribute
                                    ->productFloatValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->websiteId)
                                    ->get()->first();
        }

        //dd($attributeValue);
        if (null === $attributeValue) {
            $attributeValue = $productAttribute
                                    ->productFloatValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->defaultWebsiteId)
                                    ->get()->first();
        }

        if (isset($attributeValue->value)) {
            $value = $attributeValue->value;
            Cache::put($cacheKey, $value, $minute = 100);
        }


        }
        return $value;
    }

    private function _getProductTextValue($productAttribute) {
        $value = null;
        $attributeValue = null;

        $cacheKey = get_class($this) . "_" . $this->attributes['id'] . "_" .  $this->websiteId . "_" . $productAttribute->title;
        if (Cache::has($cacheKey)) {
            $value = Cache::get($cacheKey);
        } else {


        if (!$this->isDefaultWebsite) {
            $attributeValue = $productAttribute
                                    ->productTextValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->websiteId)
                                    ->get()->first();
        }

        if (null === $attributeValue) {
            $attributeValue = $productAttribute
                                    ->productTextValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->defaultWebsiteId)
                                    ->get()->first();
        }

        if (isset($attributeValue->value)) {
            $value = $attributeValue->value;
            Cache::put($cacheKey, $value, $minute = 100);
        }


        }
        return $value;
    }

    private function _getProductDatetimeValue($productAttribute) {
        $value = null;
        $attributeValue = null;

        $cacheKey = get_class($this) . "_" . $this->attributes['id'] . "_" . $this->websiteId . "_" . $productAttribute->title;
        if (Cache::has($cacheKey)) {
            $value = Cache::get($cacheKey);
        } else {
        if (!$this->isDefaultWebsite) {
            $attributeValue = $productAttribute
                                    ->productDatetimeValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->websiteId)
                                    ->get()->first();
        }

        if (null === $attributeValue) {
            $attributeValue = $productAttribute
                                    ->productDatetimeValues()
                                    ->where('product_id', '=', $this->attributes['id'])
                                    ->where('website_id', '=', $this->defaultWebsiteId)
                                    ->get()->first();
        }

        if (isset($attributeValue->value)) {
            $value = $attributeValue->value;
            Cache::put($cacheKey, $value, $minute = 100);
        }

        }
        return $value;
    }

    public function getFeaturedProducts($paginate = 4) {
        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->get()->first();

        if($attribute == NULL) {
            return null;
        }
        $products = Collection::make([]);
        $varcharValues = $attribute->productVarcharValues()->where('value', '=', 1)->get();

        foreach ($varcharValues as $varcharValue) {
            $products->push(self::findorfail($varcharValue->product_id));
        }

        return $products;
    }

}
