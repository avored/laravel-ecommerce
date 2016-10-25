<?php

namespace Mage2\Wishlist\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Catalog\Models\Product;

class Wishlist extends Model
{
    protected $fillable = ['website_id', 'user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
