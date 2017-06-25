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

class Mage2WishlistSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });


        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id');
            $table->integer('role_id');
            $table->timestamps();
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });


        //TAX MODULES
        Schema::table('tax_rules', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });


        //orders table foreign key setup
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('billing_address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::table('order_return_request_messages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //wishlists table foreign key setup
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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

        //Schema::drop('addresses');
        Schema::drop('roles');
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('wishlists');
    }

}
