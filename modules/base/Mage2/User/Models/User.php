<?php

namespace Mage2\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Mage2\User\Models\Wishlist;

class User extends Authenticatable
{
    use Notifiable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','phone','company_name','image_path', 'status','language'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function isInWishlist($productId)
    {
        $wishList = Wishlist::where('user_id', '=', $this->attributes['id'])
                            ->where('product_id', '=', $productId)->get();


        if (count($wishList) <= 0) {
            return false;
        }

        return true;
    }
}
