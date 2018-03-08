<?php
namespace AvoRed\Ecommerce\Models\Database;

class UserViewedProduct extends BaseModel
{

    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
