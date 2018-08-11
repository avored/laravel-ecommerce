<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvoredRelatedSchema extends Migration
{

    /**
     *
     * Install the AvoRed Featured Module Schema.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable()->default(null);
            $table->integer('related_id')->unsigned()->nullable()->default(null);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('related_id')->references('id')->on('products')->onDelete('cascade');


            $table->timestamps();

        });

    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_products');
    }

}
