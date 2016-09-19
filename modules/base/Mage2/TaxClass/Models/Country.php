<?php

namespace Mage2\TaxClass\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\Address\Models\Address;
class Country extends Model
{
    protected $fillable = [
                    'name',
                    'code'
    ];

    public function address() {
        return $this->hasOne(Address::class);
    }
}
