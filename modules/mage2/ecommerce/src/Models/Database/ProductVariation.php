<?php
namespace Mage2\Ecommerce\Models\Database;

class ProductVariation extends BaseModel
{

    protected $fillable = ['variation_id', 'product_id' ];


    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function variationProduct() {
        return $this->belongsTo(Product::class,'variation_id');
    }
}


