<?php
namespace Mage2\Common\Database\Seeds;
use Illuminate\Database\Seeder;
use Mage2\Attribute\Models\ProductAttribute;
use Mage2\Order\Models\OrderStatus;
use Mage2\Attribute\Models\AttributeDropdownOption;
use Mage2\TaxClass\Models\Country;
class Mage2EcommerceData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        OrderStatus::insert(['title' => 'pending','is_default' => 1]);

    }

}
