<?php

namespace Mage2\User\Policies;

use Mage2\User\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the user can has permissions to access route.
     *
     * @param  \Mage2\User\Models\AdminUser $adminUser
     * @return mixed
     */
    public function hasPermission(AdminUser $adminUser, $permissionName) {

        if($adminUser->is_super_admin == 1) {
            return true;
        }

        $role = $adminUser->role;
        return $role->hasPermission($permissionName);

    }



}
