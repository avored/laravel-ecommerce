<?php
namespace Mage2\Ecommerce\Models\Database;

class ProductAttributeDatetimeValue extends BaseModel
{

    protected $fillable = ['attribute_id', 'product_id' ,'value'];

    protected $dates = ['created_at','updated_at','value'];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}


