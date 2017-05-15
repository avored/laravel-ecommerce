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
            $table->integer('sort_order');
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
            ['title' => 'pending', 'sort_order' => 0],
            ['title' => 'processing', 'sort_order' => 1],
            ['title' => 'complete', 'sort_order' => 2]
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
