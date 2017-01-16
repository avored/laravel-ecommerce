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
        
        $productAttributeGroup = ProductAttributeGroup::where('title', '=','Basic')->get()->first();

        $featureAttribute = ProductAttribute::create([
            'title' => 'Is Featured',
            'product_attribute_group_id' => $productAttributeGroup->id,
            'identifier' => 'is_featured',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'sort_order' => 10,
            'validation' => 'required',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '0',
            'label' => 'No',
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '1',
            'label' => 'Yes',
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
