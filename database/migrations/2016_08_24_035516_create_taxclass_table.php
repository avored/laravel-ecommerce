<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxclassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tax_classes
         Schema::create('tax_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('country_code');
            $table->string('state_code');
            $table->string('post_code');
            $table->string('percentage');
            $table->string('priority');
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
        Schema::drop('tax_classes');
    }
}
