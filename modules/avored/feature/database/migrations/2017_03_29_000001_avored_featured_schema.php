<?php


use Illuminate\Database\Migrations\Migration;
use AvoRed\Framework\Models\Database\Property;
use AvoRed\Framework\Models\Database\PropertyDropdownOption;


class AvoredFeaturedSchema extends Migration
{

    /**
     *
     * Install the AvoRed Featured Module Schema.
     *
     * @return void
     */
    public function up()
    {

        $property = Property::create([
                            'name'          => 'Is Featured',
                            'identifier'    => 'avored-is-featured',
                            'data_type'     => 'INTEGER',
                            'field_type'    => 'SELECT',
                            'use_for_all_products'  => 1,
                            'sort_order'    => 100
                        ]);

        PropertyDropdownOption::create([
            'property_id'   => $property->id,
            'display_text'  => 'Yes'
        ]);

        PropertyDropdownOption::create([
            'property_id'   => $property->id,
            'display_text'  => 'No'
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
