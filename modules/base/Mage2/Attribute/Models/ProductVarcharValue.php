<?php

namespace Mage2\Attribute\Models;

use Mage2\Framework\System\Models\BaseModel;

class ProductVarcharValue extends BaseModel
{
    protected $fillable = ['website_id', 'product_id', 'attribute_id', 'value'];

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
