<?php
namespace Mage2\Ecommerce\Models\Database;

class ProductVariation extends BaseModel
{

    protected $fillable = ['variation_id', 'product_id' ];



    public function variation() {
        return $this->belongsTo(Product::class,'variation_id');

    }
}


