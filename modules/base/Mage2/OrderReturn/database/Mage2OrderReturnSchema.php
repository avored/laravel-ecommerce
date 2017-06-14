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

class Mage2OrderReturnSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install()
    {

        Schema::create('order_return_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->enum('user_option',['REFUND','RETURN']);
            $table->enum('status',['INIT_REQUEST','APPROVE','DISAPPROVE','CUSTOMER_SENT_PRODUCT'])->default('INIT_REQUEST');
            $table->timestamps();
        });

        Schema::create('order_return_request_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_return_request_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty');
            $table->timestamps();
        });

        Schema::create('order_return_request_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_return_request_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('user_type',['USER','ADMIN_USER']);
            $table->text('message_text');
            $table->timestamps();
        });


    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall()
    {
        Schema::drop('order_return_requests');
        Schema::drop('order_return_request_products');
        Schema::drop('order_return_request_messages');
    }

}
