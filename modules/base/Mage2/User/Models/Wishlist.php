<?php

namespace Mage2\User\Models;

use Mage2\Catalog\Models\Product;
use Mage2\Framework\System\Models\BaseModel;

class Wishlist extends BaseModel
{
    protected $fillable = ['website_id', 'user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
