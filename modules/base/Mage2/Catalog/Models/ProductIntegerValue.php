<?php

namespace Mage2\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIntegerValue extends Model
{
    protected $fillable = [ 'product_id', 'attribute_id', 'value'];

    public function productAttribute()
    {
        $this->belongsTo(ProductAttribute::class);
    }
}
