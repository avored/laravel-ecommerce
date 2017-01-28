<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\System\Models\Module as ModuleModel;


class Mage2SystemSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {

       Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id')->unsigned();
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
        
          Schema::table('configurations', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

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
