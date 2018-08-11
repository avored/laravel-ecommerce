<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\PropertyDropdownOption;

class AvoredSubscribeSchema extends Migration
{

    /**
     *
     * Install the AvoRed Product Brand Module Schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name')->nullable();
            $table->string('email')->nullable();
           $table->timestamps();
        });
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribes');
    }

}
