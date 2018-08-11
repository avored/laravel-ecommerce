<?php
use Illuminate\Database\Migrations\Migration;

use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\PropertyDropdownOption;

class AvoredBrandSchema extends Migration
{

    /**
     *
     * Install the AvoRed Product Brand Module Schema.
     *
     * @return void
     */
    public function up()
    {
        $property = Property::create([
                            'name'                  => 'Brand',
                            'identifier'            => 'avored-brand',
                            'data_type'             => 'INTEGER',
                            'field_type'            => 'SELECT',
                            'use_for_all_products'  => 1,
                            'sort_order'            => 200
                        ]);

        PropertyDropdownOption::create([
            'property_id'   => $property->id,
            'display_text'  => 'Test Brand Name'
        ]);
    }

    /**
     * Uninstall the AvoRed Address Module Schema.
     *
     * @return void
     */
    public function down()
    {
    }

}
