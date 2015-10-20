<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    	Schema::create('products_images', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('product_id')->unsigned()->index();
    		$table->string('path')->default('');
            $table->tinyInteger('is_default');
    		$table->timestamps();

    	});

        Schema::table('products_images',function(Blueprint $table){
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    		 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('products_images');
    }
}
