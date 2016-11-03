<?php

namespace Mage2\User\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\User\Models\Role;

class Permission extends Model
{
    protected $fillable = ['name'];


    /**
     * Permission belongs to many role
     *
     * @return \Mage2\User\Models\Role
     */

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public static function getPermissionByName($name) {
        $instance = new static;
        return $instance->where('name','=', $name)->first();
    }
}
