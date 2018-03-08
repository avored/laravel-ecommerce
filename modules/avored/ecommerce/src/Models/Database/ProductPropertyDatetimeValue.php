<?php
namespace AvoRed\Ecommerce\Models\Database;

class ProductPropertyDatetimeValue extends BaseModel
{

    protected $fillable = ['property_id', 'product_id' ,'value'];

    protected $dates = ['created_at','updated_at','value'];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function property() {
        return $this->belongsTo(Property::class);
    }

}


