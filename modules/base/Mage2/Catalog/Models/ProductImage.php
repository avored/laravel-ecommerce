<?php

namespace Mage2\Catalog\Models;

use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Models\BaseModel;

class ProductImage extends BaseModel
{
    protected $fillable = [ 'product_id', 'path'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
