<?php
namespace AvoRed\Ecommerce\Models\Database;

class RelatedProduct extends BaseModel
{
    protected $fillable = ['product_id', 'related_product_id'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
