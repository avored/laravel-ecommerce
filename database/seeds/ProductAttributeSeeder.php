<?php

use Illuminate\Database\Seeder;
use CrazyCommerce\Admin\Models\ProductAttribute;
use CrazyCommerce\Admin\Models\OrderStatus;
use CrazyCommerce\Admin\Models\AttributeDropdownOption;
class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttribute::insert([
            [
                'title' => 'Title',
                'identifier' => 'title',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255'
            ],

            [
                'title' => 'Price',
                'identifier' => 'price',
                'type' => 'FLOAT',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255|regex:/^-?\\d*(\\.\\d+)?$/'
            ],
            [
                'title' => 'Image',
                'identifier' => 'image',
                'type' => 'FILE',
                'field_type' => 'FILE',
                'validation' => ''
            ],
            [
                'title' => 'SKU',
                'identifier' => 'sku',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255'
            ],
            [
                'title' => 'Slug',
                'identifier' => 'slug',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255|alpha_dash'
            ],

            [
                'title' => 'Page Title',
                'identifier' => 'page_title',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => 'required|max:255'
            ],
            [
                'title' => 'Page Description',
                'identifier' => 'page_description',
                'type' => 'TEXT',
                'field_type' => 'TEXTAREA',
                'validation' => 'max:255'
            ],

            [
                'title' => 'Qty',
                'identifier' => 'qty',
                'type' => 'VARCHAR',
                'field_type' => 'TEXT',
                'validation' => ''
            ],


            [
                'title' => 'Description',
                'identifier' => 'description',
                'type' => 'VARCHAR',
                'field_type' => 'TEXTAREA',
                'validation' => 'required'
            ],


        ]);

        $statusAttribute = ProductAttribute::create([
            'title' => 'Status',
            'identifier' => 'status',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'validation' => 'required'
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '1',
            'label' => 'Enabled'
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $statusAttribute->id,
            'value' => '0',
            'label' => 'Disabled'
        ]);



        $featureAttribute = ProductAttribute::create([
            'title' => 'Is Featured',
            'identifier' => 'is_featured',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'validation' => 'required'
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '0',
            'label' => 'No'
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $featureAttribute->id,
            'value' => '1',
            'label' => 'Yes'
        ]);

        $inStockAttribute = ProductAttribute::create([
                                            'title' => 'In Stock',
                                            'identifier' => 'in_stock',
                                            'type' => 'VARCHAR',
                                            'field_type' => 'SELECT',
                                            'validation' => 'required'
                                        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '1',
            'label' => 'Yes'
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $inStockAttribute->id,
            'value' => '0',
            'label' => 'No'
        ]);

        $trackStockAttribute = ProductAttribute::create([
            'title' => 'Track Stock',
            'identifier' => 'track_stock',
            'type' => 'VARCHAR',
            'field_type' => 'SELECT',
            'validation' => ''
        ]);

        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '1',
            'label' => 'Yes'
        ]);
        AttributeDropdownOption::create([
            'product_attribute_id' => $trackStockAttribute->id,
            'value' => '0',
            'label' => 'No'
        ]);
        OrderStatus::insert(
                        ['title' => 'pending','status' => 1,'is_default' => 1],
                        ['title' => 'processing','status' => 1,'is_default' => 0],
                        ['title' => 'complete','status' => 1,'is_default' => 0]
                );
    }
}
