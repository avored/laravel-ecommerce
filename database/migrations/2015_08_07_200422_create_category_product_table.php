<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->timestamps();

        });

        /*
         * @TODO fix later on
        Schema::table('category_product',function(Blueprint $table){
            $table->foreign('product_id')->reference('id')->on('products')->onDelete('cascade');

        });

        Schema::table('category_product',function(Blueprint $table) {
            $table->foreign('category_id')->reference('id')->on('categories')->onDelete('cascade');
        });
        */
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_product');
    }
}
