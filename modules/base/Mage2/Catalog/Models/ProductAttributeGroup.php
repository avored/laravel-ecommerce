<?php

namespace Mage2\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroup extends Model
{
    protected $fillable = ['title','identifier','sort_order'];
}
