<?php

namespace Mage2\configuration\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['website_id','configuration_key','configuration_value'];
    
    public static function getConfiguration($key) {
        $model = new static();
        
        $row = $model->where('configuration_key','=',$key)->first();
        if($row != NULL) {
            return $row->configuration_value;
        }
        
        return null;
    }
}
