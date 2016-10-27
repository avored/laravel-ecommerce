<?php

namespace Mage2\Attribute\Models;


use Mage2\Framework\Http\Models\BaseModel;

class ProductTextValue extends BaseModel
{
    protected $fillable = ['website_id', 'product_id', 'attribute_id', 'value'];

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
