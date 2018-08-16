<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvoredPromotionSchema extends Migration
{

    /**
     *
     * Install the AvoRed Featured Module Schema.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->enum('discount_type',['PERCENTAGE','FIXED'])->nullable()->default(null);
            $table->float('amount')->nullable()->default(null);

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
        Schema::dropIfExists('promotions');
    }

}
