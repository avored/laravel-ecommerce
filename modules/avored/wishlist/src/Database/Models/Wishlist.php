<?php
namespace AvoRed\Wishlist\Database\Models;

use AvoRed\Framework\Database\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['product_id','customer_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
