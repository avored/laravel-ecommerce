<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatetimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_datetime_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id');
            $table->integer('product_id');
            $table->integer('product_attribute_id');
            $table->timestamp('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_datetime_values');
    }
}
