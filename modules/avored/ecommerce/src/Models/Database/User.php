<?php

namespace AvoRed\Ecommerce\Models\Database;

use AvoRed\Framework\Image\LocalFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'company_name', 'image_path', 'status', 'language', 'activation_token',
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

    public function getImagePathAttribute()
    {
        return (empty($this->attributes['image_path'])) ? '' : new LocalFile($this->attributes['image_path']);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getShippingAddress()
    {
        $address = $this->addresses()->where('type', '=', 'SHIPPING')->first();

        return $address;
    }

    public function getBillingAddress()
    {
        $address = $this->addresses()->where('type', '=', 'Billing')->first();

        return $address;
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
