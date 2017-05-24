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


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\System\Models\Module as ModuleModel;
use Mage2\System\Models\Configuration;

class Mage2SystemSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {

       Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('configuration_key')->nullable()->default(null);
            $table->string('configuration_value')->nullable()->default(null);
            $table->timestamps();
        });
        
          Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->unique();
            $table->enum('type',['SYSTEM','COMMUNITY'])->default('COMMUNITY');
            $table->string('name');
            $table->enum('status',['ACTIVE','INACTIVE']);
            $table->timestamps();
        });

        Configuration::create(['configuration_key' => 'general_site_title','configuration_value' => 'Mage2 Laravel Ecommerce']);
        Configuration::create(['configuration_key' => 'general_site_description','configuration_value' => 'Mage2 Laravel Ecommerce']);

        ModuleModel::create(['identifier' => 'mage2-cart',
            'name'=> 'Mage2 Cart',
            'type' => 'SYSTEM',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-catalog',
            'name'=> 'Mage2 Catalog',
            'type' => 'SYSTEM',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-checkout',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Checkout',
            'status' => 'ACTIVE'
        ]);

        ModuleModel::create(['identifier' => 'mage2-freeshipping',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Free Shipping',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-order',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Order',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-page',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Page',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-paypal',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Paypal',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-pickup',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Pickup',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-system',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 System',
            'status' => 'ACTIVE'
        ]);
        ModuleModel::create(['identifier' => 'mage2-taxclass',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 Tax class',
            'status' => 'ACTIVE'
        ]);

        ModuleModel::create(['identifier' => 'mage2-user',
            'type' => 'SYSTEM',
            'name'=> 'Mage2 User',
            'status' => 'ACTIVE'
        ]);
        
         ModuleModel::create(['identifier' => 'mage2-contactus',
            'type' => 'COMMUNITY',
            'name'=> 'Mage2 Contact Us',
            'status' => 'ACTIVE'
        ]);

        
        ModuleModel::create(['identifier' => 'mage2-feature',
            'type' => 'COMMUNITY',
            'name'=> 'Mage2 Feature',
            'status' => 'ACTIVE'
        ]);

    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {
       Schema::drop('configurations');
    }

}
