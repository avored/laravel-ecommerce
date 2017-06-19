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
use Mage2\Catalog\Models\ProductAttributeGroup;
use Mage2\Catalog\Models\AttributeDropdownOption;
use Mage2\Catalog\Models\ProductAttribute;

class Mage2CatalogSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install()
    {


        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('identifier')->unique();
            $table->enum('field_type', ['TEXT', 'TEXTAREA', 'CKEDITOR', 'SELECT', 'FILE', 'DATETIME']);
            $table->tinyInteger('use_as_variation');
            $table->tinyInteger('is_system')->default(1);
            $table->integer('sort_order')->nullable()->default(0);
            $table->timestamps();
        });


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
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });

        Schema::create('attribute_dropdown_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_attribute_id')->unsigned();
            $table->string('display_text');
            $table->timestamps();
        });


        Schema::create('related_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('related_products_id')->unsigned();
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
    public function uninstall()
    {

        Schema::drop('product_attributes');
        Schema::drop('products');
        Schema::drop('attribute_dropdown_options');
        Schema::drop('related_products');
    }

}
