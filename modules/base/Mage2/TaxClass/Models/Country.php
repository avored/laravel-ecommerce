<?php

namespace Mage2\TaxClass\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
                    'name',
                    'code'
    ];
}
