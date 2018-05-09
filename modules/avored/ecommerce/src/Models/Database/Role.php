<?php

namespace AvoRed\Ecommerce\Models\Database;

class Role extends BaseModel
{
    protected $fillable = ['name', 'description'];


    public static function options($empty = true) {

        $model = new static();

        $options = $model->all()->pluck('name', 'id');
        if(true === $empty) {
            $options->prepend('Please Select', null);
        }
        return $options;
    }
    /**
     * Role can be assigned to many users.
     */
    public function user()
    {
        return $this->hasMany(AdminUser::class);
    }

    /**
     * Role has many Permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionName)
    {
        $permissions = explode(',', $permissionName);

        $returnData = true;
        foreach ($permissions as $permission) {
            if ($this->permissions->pluck('name')->contains($permission) == false) {
                $returnData = false;
            }
        }

        return $returnData;
    }
}
