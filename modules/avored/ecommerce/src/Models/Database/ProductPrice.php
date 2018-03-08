<?php
namespace AvoRed\Ecommerce\Models\Database;

class ProductPrice extends BaseModel
{
    protected $fillable = ['product_id', 'price'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
