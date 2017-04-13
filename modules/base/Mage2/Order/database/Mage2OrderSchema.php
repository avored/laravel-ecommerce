<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\Order\Models\OrderStatus;

class Mage2OrderSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_address_id')->unsigned();
            $table->integer('billing_address_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('shipping_option');
            $table->string('payment_option');
            $table->integer('order_status_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('qty');
            $table->decimal('price', 11, 6);
            $table->decimal('tax_amount', 11, 6);
            $table->timestamps();


        });

        Schema::create('order_product_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('product_variation_id')->unsigned();
            $table->timestamps();
        });


        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_default')->default(0);
            $table->boolean('is_last_stage')->default(0);
            $table->timestamps();
        });

        //orders table foreign key setup
        Schema::table('order_product', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('order_product_variations', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        OrderStatus::insert(
            ['title' => 'pending', 'is_default' => 1, 'is_last_stage' => 0],
            ['title' => 'processing', 'is_default' => 0, 'is_last_stage' => 0],
            ['title' => 'complete', 'is_default' => 0, 'is_last_stage' => 1]
        );

    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {
        Schema::drop('orders');
        Schema::drop('product_order');
        Schema::drop('order_statuses');
    }

}
