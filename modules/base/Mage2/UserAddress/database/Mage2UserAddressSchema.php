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

class Mage2UserAddressSchema extends Migration
{

    /**
     * Install the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function install()
    {

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['SHIPPING', 'BILLING']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address1');
            $table->string('address2');
            $table->string('postcode');
            $table->string('city');
            $table->string('state');
            $table->integer('country_id')->unsigned();
            $table->string('phone');
            $table->timestamps();
        });

        //addresses table foreign key setup
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });


        $path = public_path() . '/countries.json';

        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $code => $name) {
            $countires[] = ['code' => $code, 'name' => $name];
        }

        Country::insert($countires);


    }

    /**
     * Uninstall the Mage2 Catalog Module Schema.
     *
     * @return void
     */
    public function uninstall()
    {
        Schema::drop('addresses');
    }

}
