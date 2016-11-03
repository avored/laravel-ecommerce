<?php

namespace Mage2\User\Models;

use Illuminate\Database\Eloquent\Model;
use Mage2\User\Models\AdminUser;
use Mage2\User\Models\Permission;

class Role extends Model
{
    protected $fillable = ['name','description'];
    
    /**
     * Role can be assigne to many users
     * 
     * @return \Mage2\User\Models\User
     */
    public function user() {
        return $this->hasMany(AdminUser::class);
    }


    /**
     * Role has many Permissions
     *
     * @return \Mage2\User\Models\Role
     */

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionName) {
        return $this->permissions->pluck('name')->contains($permissionName);
    }
}

