<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\AttributeDropdownOption;
use Mage2\Catalog\Models\ProductAttributeGroup;
class Mage2FeatureSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function install()
    {

        $featureAttribute = ProductAttribute::create([
            'title' => 'Is Featured',
            'identifier' => 'is_featured',
            'field_type' => 'SELECT',
            'sort_order' => 10,
            'use_as_variation' => '0',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'display_text' => 'No'
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'display_text' => 'Yes'
        ]);

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function uninstall()
    {
       
        $attribute  = ProductAttribute::where('identifier','=','is_featured')->get()->first();
        
        $attribute->delete();
            
    }
}
