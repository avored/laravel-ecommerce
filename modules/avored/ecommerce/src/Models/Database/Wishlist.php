<?php

namespace AvoRed\Ecommerce\Models\Database;

use Illuminate\Database\Eloquent\Model;
use AvoRed\Framework\Models\Database\Product;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
