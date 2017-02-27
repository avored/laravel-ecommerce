<?php

namespace Mage2\Catalog\Models;

use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Models\BaseModel;

class ProductPrice extends BaseModel
{
    protected $fillable = [ 'product_id', 'price'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
