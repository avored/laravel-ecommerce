<?php

namespace Mage2\TaxClass\Models;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    protected $fillable = [
                    'title',
                    'country_code',
                    'state_code',
                    'post_code',
                    'percentage',
                    'priority',
    ];
}
