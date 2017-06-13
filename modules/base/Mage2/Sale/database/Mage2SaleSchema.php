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
use Mage2\Sale\Models\OrderStatus;

class Mage2SaleSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {


        Schema::create('gift_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->float('discount',6,2);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status',['ENABLED','DISABLED']);
            $table->timestamps();
        });


        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('sort_order');
            $table->timestamps();
        });

        OrderStatus::insert([
            ['title' => 'Pending', 'sort_order' => 0],
            ['title' => 'Delivered', 'sort_order' => 1],
            ['title' => 'Received', 'sort_order' => 2],
            ['title' => 'Canceled', 'sort_order' => 3],
        ]);


        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });


    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {
        Schema::dropIfExits('gift_coupons');
    }



}
