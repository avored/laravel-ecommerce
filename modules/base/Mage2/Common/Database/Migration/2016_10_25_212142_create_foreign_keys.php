<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //addresses table foreign key setup
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });

        //product_varchar_values table foreign key setup
        Schema::table('product_varchar_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_varchar_values table foreign key setup
        Schema::table('product_float_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_text_values table foreign key setup
        Schema::table('product_text_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_integer_values table foreign key setup
        Schema::table('product_integer_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_datetime_values table foreign key setup
        Schema::table('product_datetime_values', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_datetime_values table foreign key setup
        Schema::table('attribute_dropdown_options', function (Blueprint $table) {
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
        });

        //product_website table foreign key setup
        Schema::table('product_website', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

        //categories table foreign key setup
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

        //category_product table foreign key setup
        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //related_products table foreign key setup
        Schema::table('related_products', function (Blueprint $table) {
            $table->foreign('related_products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //configurations table foreign key setup
        Schema::table('configurations', function (Blueprint $table) {
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
        });

        //orders table foreign key setup
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });

        //orders table foreign key setup
        Schema::table('product_order', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //reviews table foreign key setup
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        //wishlists table foreign key setup
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
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
    }
}
