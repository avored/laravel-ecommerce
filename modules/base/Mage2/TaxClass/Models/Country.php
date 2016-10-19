<?php

namespace Mage2\TaxClass\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Address\Models\Address;

class Country extends Model {

    protected $fillable = [
        'name',
        'code'
    ];

    public function address() {
        return $this->hasOne(Address::class);
    }

    public static function getCountriesOptions($name = 'name', $id = 'id' ) {
        $model = new static();

        $options = $model->all()->pluck($name, $id);
        return $options;
    }

}
