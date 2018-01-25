<?php
namespace Mage2\Ecommerce\Models\Database;

class RelatedProduct extends BaseModel
{
    protected $fillable = ['product_id', 'related_product_id'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
