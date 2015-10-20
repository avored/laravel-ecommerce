<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->references('id')->on('customers');
            $table->string('shipping_address_id');
            $table->string('billing_address_id');
            $table->string('shipping_type');
            $table->string('payment_type');
            $table->string('note');
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
        //
         Schema::drop('orders');
    }
}
