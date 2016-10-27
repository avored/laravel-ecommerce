<?php

namespace Mage2\Catalog\Models;

use Mage2\Framework\Http\Models\BaseModel;

class RelatedProduct extends BaseModel
{
    protected $fillable = ['product_id', 'related_product_id'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
