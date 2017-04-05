<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\Catalog\Models\ProductAttributeGroup;
use Mage2\Catalog\Models\AttributeDropdownOption;
use Mage2\Catalog\Models\ProductAttribute;

class Mage2CatalogSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {


        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('identifier')->unique();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME']);
            $table->tinyInteger('use_as_variation');
            $table->tinyInteger('is_system')->default(0);
            $table->integer('sort_order')->nullable()->default(0);

            $table->timestamps();
        });


        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);

            $table->text('description')->nullable()->default(null);
            //'status','','','qty','','page_title','page_description'

            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->decimal('qty',10,6)->nullable();
            $table->tinyInteger('is_taxable')->nullable()->default(null);

            $table->string('page_title')->nullable()->default(null);
            $table->string('page_description')->nullable()->default(null);

            $table->tinyInteger('has_variation')->nullable()->default(0);
            $table->timestamps();
        });



        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->decimal('price',10,6);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->text('path');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });

        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_attribute_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(NULL);
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('related_products_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('star');
            $table->string('comment');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('DISABLED');
            $table->timestamps();
        });


        Schema::create('product_variations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->integer('attribute_dropdown_option_id')->unsigned();
            $table->integer('sub_product_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');

            $table->foreign('sub_product_id')
                ->references('id')->on('products')->onDelete('cascade');

            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');

            $table->foreign('attribute_dropdown_option_id')
                ->references('id')->on('attribute_dropdown_options')->onDelete('cascade');
        });



        //product_datetime_values table foreign key setup
        Schema::table('attribute_dropdown_options', function (Blueprint $table) {
            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');
        });


        /*
        Schema::create('product_varchar_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->string('value');
            $table->timestamps();

        $table->foreign('product_attribute_id')
            ->references('id')->on('product_attributes')->onDelete('cascade');

        $table->foreign('product_id')
            ->references('id')->on('products')->onDelete('cascade');

        });
        */


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

    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {

        Schema::drop('product_attributes');
        Schema::drop('products');
        Schema::drop('attribute_dropdown_options');
        Schema::drop('categories');
        Schema::drop('category_product');
        Schema::drop('related_products');
        Schema::drop('reviews');
    }

}
