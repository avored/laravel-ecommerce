<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mage2TaxClassSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {

        Schema::create('tax_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default(null);
            $table->string('country_code')->nullable()->default(null);
            $table->string('state_code')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('post_code')->nullable()->default(null);
            $table->float('percentage',8,6)->nullable()->default(null);
            $table->integer('priority')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {
        Schema::create('pages');
    }

}
