<?php

namespace Mage2\Catalog\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\Catalog\Models\Review;
use Illuminate\Support\Facades\Cache;

class Product extends BaseModel {

    protected $fillable = ['title','slug','sku','description','status','in_stock','track_stock','qty','is_taxable','page_title','page_description','has_variation'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function productVariations() {
        return $this->hasMany(ProductVariation::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function prices() {
        return $this->hasMany(ProductPrice::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function relatedProducts() {
        return $this->hasMany(RelatedProduct::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
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

    public function getPriceAttribute() {
        $row = $this->prices()->first();

        return (isset($row->price)) ? $row->price : null ;
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
