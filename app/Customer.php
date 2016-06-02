<?php

namespace App;

use App\Order;
use App\Address;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'password' ,'remember_token',
    ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
