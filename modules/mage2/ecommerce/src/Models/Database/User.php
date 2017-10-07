<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Models\Database;;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mage2\Ecommerce\Image\LocalFile;


class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'company_name', 'image_path', 'status', 'language'
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
        return (empty($this->attributes['image_path'])) ? "" : new LocalFile($this->attributes['image_path']);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }


    public function userViewedProducts()
    {
        return $this->hasMany(UserViewedProduct::class);
    }



    public function getShippingAddress()
    {
        $address = $this->addresses()->where('type','=','SHIPPING')->first();
        return $address;
    }

    public function getBillingAddress()
    {
        $address = $this->addresses()->where('type','=','Billing')->first();
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
