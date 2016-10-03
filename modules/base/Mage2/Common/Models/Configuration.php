<?php

namespace Mage2\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['website_id','configuration_key','configuration_value'];
}
