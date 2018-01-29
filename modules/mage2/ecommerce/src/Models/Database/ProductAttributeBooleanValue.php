<?php
namespace Mage2\Ecommerce\Models\Database;

class ProductAttributeBooleanValue extends BaseModel
{

    protected $fillable = ['attribute_id', 'product_id' ,'value'];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}


