<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvoredReviewSchema extends Migration
{

    /**
     *
     * Install the AvoRed Featured Module Schema.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable()->default(null);

            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->float('star',2,1)->nullable();
            $table->text('content')->nullable()->default(null);

            $table->enum('status',['APPROVED','PENDING'])->default('PENDING');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('product_reviews');
    }

}
