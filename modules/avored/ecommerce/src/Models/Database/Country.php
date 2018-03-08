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

    public static function getCountriesOptions($empty = false)
    {
        $model = new static();

        if(true === $empty) {
            $return = Collection::make(['' => 'Please Select'] + $model->orderBy('name','asc')->pluck('name', 'id')->toArray());
        } else {
            $return = $model->all()->pluck('name', 'id');
        }

        return $return;
    }
}
