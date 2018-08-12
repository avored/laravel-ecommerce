<?php
namespace AvoRed\Review\Models\Database;

use AvoRed\Framework\Models\Database\User;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = ['product_id','user_id','star','content','status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}