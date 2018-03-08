<?php
namespace AvoRed\Ecommerce\Models\Database;

class ProductPropertyDecimalValue extends BaseModel
{

    protected $fillable = ['property_id', 'product_id' ,'value'];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function property() {
        return $this->belongsTo(Property::class);
    }

}


