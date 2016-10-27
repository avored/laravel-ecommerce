<?php

namespace Mage2\configuration\Models;

use Mage2\Framework\Http\Models\BaseModel;

class Configuration extends BaseModel
{
    protected $fillable = ['website_id', 'configuration_key', 'configuration_value'];

    public static function getConfiguration($key)
    {
        $model = new static();

        $row = $model->where('configuration_key', '=', $key)->first();
        if ($row != null) {
            return $row->configuration_value;
        }
    }
}
