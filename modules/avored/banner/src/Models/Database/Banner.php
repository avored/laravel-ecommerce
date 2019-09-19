<?php
namespace AvoRed\Banner\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['name','image_path','alt_text','url','target','status','sort_order'];
}
