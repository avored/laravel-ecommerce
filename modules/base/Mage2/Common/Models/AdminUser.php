<?php

namespace Mage2\Common\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name' ,'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getFullNameAttribute() {
        return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
    }
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
