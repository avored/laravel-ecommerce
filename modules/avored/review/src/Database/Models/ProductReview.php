<?php
namespace AvoRed\Review\Database\Models;

use AvoRed\Framework\Database\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['product_id','name', 'email', 'star','content','status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
