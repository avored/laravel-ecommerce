<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mage2PaypalSchema extends Migration {

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install() {
        Schema::create('paypal_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paymentId');
            $table->string('token');
            $table->string('PayerId');
            $table->timestamps();
        });
    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall() {
        Schema::drop('paypal_records');
    }

}
