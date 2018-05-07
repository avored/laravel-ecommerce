<?php

namespace AvoRed\Ecommerce\Models\Database;

use Illuminate\Support\Collection;

class Country extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public static function options($empty = true) {

        $model = new static();

        $options = $model->all()->pluck('name', 'id');
        if(true === $empty) {
            $options->prepend('Please Select', null);
        }
        return $options;
    }
}
