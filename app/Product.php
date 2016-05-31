<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','price'];

    public function getPriceAttribute() {

        return  number_format($this->attributes['price'],2);
    }
}