<?php
namespace Mage2\Ecommerce\Models\Database;

class Review extends BaseModel
{
    protected $fillable = ['product_id', 'user_id', 'star', 'comment', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }


    public function getUserFullNameAttribute()
    {
        return $this->user->full_name;
    }
}
