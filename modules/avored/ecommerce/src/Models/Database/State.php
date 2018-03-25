<?php

namespace AvoRed\Ecommerce\Models\Database;

class State extends BaseModel
{
    protected $fillable = [
        'country_id',
        'name',
        'code',
    ];

    public function state()
    {
        return $this->belongsTo(Country::class);
    }

    public static function getStateOptions($name = 'name', $id = 'id')
    {
        $model = new static();
        $options = $model->all()->pluck($name, $id);

        return $options;
    }
}
