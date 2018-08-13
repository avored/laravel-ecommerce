<?php
namespace AvoRed\Promotion\Models\Database;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Promotion extends Model
{
    protected $fillable = ['name','description','discount_type','amount'];
}
