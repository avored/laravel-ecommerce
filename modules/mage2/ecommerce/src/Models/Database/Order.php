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
namespace Mage2\Ecommerce\Models\Database;

class Order extends BaseModel
{
    protected $fillable = [
        'shipping_address_id',
        'billing_address_id',
        'user_id',
        'shipping_option',
        'payment_option',
        'order_status_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'qty', 'tax_amount');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderReturnRequest() {
        return $this->hasOne(OrderReturnRequest::class);
    }

    public function getShippingAddressAttribute()
    {
        $shippingAddress = Address::findorfail($this->attributes['shipping_address_id']);

        return $shippingAddress;
    }

    public function getOrderStatusTitleAttribute()
    {
        return $this->orderStatus->title;
    }

    public function getBillingAddressAttribute()
    {
        $address = Address::findorfail($this->attributes['billing_address_id']);

        return $address;
    }
}
