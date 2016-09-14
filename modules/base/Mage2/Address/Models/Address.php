<?php

namespace Mage2\Address\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
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
                    'country',
                    'phone',
    ];
}
