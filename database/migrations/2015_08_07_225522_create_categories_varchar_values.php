<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesVarcharValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('categories_varchar_values', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('entity_id')->unsigned()->index();
                $table->integer('attribute_id')->unsigned()->index();
                $table->string('value');
                $table->timestamps();
            });
            
            Schema::table('categories_varchar_values',function(Blueprint $table){
                $table->foreign('entity_id')->references('id')->on('categories')->onDelete('cascade');
                $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories_varchar_values');
    }
}
