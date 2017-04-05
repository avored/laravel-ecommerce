<?php

namespace Mage2\TaxClass\Models;

use Mage2\User\Models\Address;
use Mage2\Framework\System\Models\BaseModel;

class Country extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public static function getCountriesOptions($name = 'name', $id = 'id')
    {
        $model = new static();

        $options = $model->all()->pluck($name, $id);

        return $options;
    }
}
