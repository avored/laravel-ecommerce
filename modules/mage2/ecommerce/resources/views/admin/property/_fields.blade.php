


@include('mage2-ecommerce::forms.text',['name' => 'name','label' => 'Name'])
@include('mage2-ecommerce::forms.text',['name' => 'identifier','label' => 'Identifier'])


@include('mage2-ecommerce::forms.select',['name' => 'field_type',
                                            'label' => 'Field Type',
                                            'options' => ['text' => 'Text Field']
                                        ])


@include('mage2-ecommerce::forms.text',['name' => 'sort_order','label' => 'Sort Order'])