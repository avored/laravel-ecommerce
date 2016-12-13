<?php

use Illuminate\Database\Seeder;
use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\AttributeDropdownOption;
use Mage2\Catalog\Models\ProductAttributeGroup;

class Mage2FeatureSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //

        $productAttributeGroup = ProductAttributeGroup::where('title', '=','Basic')->get()->first();

        $featureAttribute = ProductAttribute::create([
            'title' => 'Is Featured',
            'product_attribute_group_id' => $productAttributeGroup->id,
            'identifier' => 'is_featured',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
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

}
