<?php

namespace Mage2\Review\Models;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['product_id','user_id','star','content'];
}
