<?php

namespace Mage2\Catalog\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Catalog\Models\Product;

class RelatedProduct extends Model
{
    protected $fillable = ['product_id','related_product_id'];
    
    public function product() {
        $this->belongsTo(Product::class);
    }
}
