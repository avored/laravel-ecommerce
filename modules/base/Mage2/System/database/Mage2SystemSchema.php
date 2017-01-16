<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('configuration_key');
            $table->string('configuration_value');
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
