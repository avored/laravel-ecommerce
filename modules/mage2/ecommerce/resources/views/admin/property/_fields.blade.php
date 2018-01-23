


@include('mage2-ecommerce::forms.text',['name' => 'name','label' => 'Name'])
@include('mage2-ecommerce::forms.text',['name' => 'identifier','label' => 'Identifier'])

@include('mage2-ecommerce::forms.select',['name' => 'data_type',
                                            'label' => 'Data Type',
                                            'options' => [
                                                        'VARCHAR' => 'Varchar (Max 255)',
                                                        'DECIMAL' => 'Decimal',
                                                        'TEXT' => 'Text (Big Text e.g Description)',
                                                        'INTEGER' => 'Integer',
                                                        'DATETIME' => 'Date Time',
                                                        'BOOLEAN' => 'Boolean'
                                                        ]
                                        ])



@include('mage2-ecommerce::forms.select',['name' => 'field_type',
                                            'label' => 'Field Type',
                                            'options' => [
                                                        'TEXT' => 'Text Field',
                                                        'CHECKBOX' => 'Check box'
                                                        ]
                                        ])


@include('mage2-ecommerce::forms.text',['name' => 'sort_order','label' => 'Sort Order'])