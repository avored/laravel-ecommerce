<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mage2\TaxClass\Models\Country;

class Mage2ProductSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(null);
            $table->tinyInteger('in_stock')->nullable()->default(null);
            $table->tinyInteger('track_stock')->nullable()->default(null);
            $table->decimal('qty', 10, 6)->nullable();
            $table->tinyInteger('is_taxable')->nullable()->default(null);

            $table->string('page_title')->nullable()->default(null);
            $table->string('page_description')->nullable()->default(null);

            $table->tinyInteger('has_variation')->nullable()->default(0);
            $table->timestamps();
        });


        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->decimal('price', 10, 6);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });


        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->text('path');
            $table->boolean('is_main_image')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });


        //related_products table foreign key setup
        Schema::table('related_products', function (Blueprint $table) {
            $table->foreign('related_products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });


        Schema::table('product_varchar_values', function (Blueprint $table) {

            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');

        });

        Schema::table('product_variations', function (Blueprint $table) {

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');

            $table->foreign('sub_product_id')
                ->references('id')->on('products')->onDelete('cascade');

            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes')->onDelete('cascade');

            $table->foreign('attribute_dropdown_option_id')
                ->references('id')->on('attribute_dropdown_options')->onDelete('cascade');
        });

        //category_product table foreign key setup
        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });


        Schema::table('order_product', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('order_product_variations', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        Schema::drop('product_prices');
        Schema::drop('product_images');
    }

}
