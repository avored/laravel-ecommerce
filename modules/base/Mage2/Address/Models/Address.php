<?php

namespace Mage2\Address\Models;

use Mage2\System\Models\BaseModel;
use Mage2\TaxClass\Models\Country;

class Address extends BaseModel
{
    protected $fillable = [
                    'user_id',
                    'type',
                    'first_name',
                    'last_name',
                    'address1',
                    'address2',
                    'area',
                    'city',
                    'state',
                    'country_id',
                    'phone',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
