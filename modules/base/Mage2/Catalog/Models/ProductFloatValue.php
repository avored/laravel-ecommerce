<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductFloatValue extends BaseModel
{
    protected $fillable = ['product_id', 'attribute_id', 'value'];

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
