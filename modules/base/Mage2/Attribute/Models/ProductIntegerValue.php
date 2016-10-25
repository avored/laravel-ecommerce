<?php

namespace Mage2\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIntegerValue extends Model
{
    protected $fillable = ['website_id', 'product_id', 'attribute_id', 'value'];

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
