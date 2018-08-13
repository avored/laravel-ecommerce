

@include('avored-framework::forms.text',['name' => 'name','label' => __('avored-promotion::promotion.name')])

@include('avored-framework::forms.textarea',['name' => 'description','label' => __('avored-promotion::promotion.description')])


@include('avored-framework::forms.select',['name' => 'discount_type',
                                        'label' => __('avored-promotion::promotion.discount_type'),
                                        'options' => ['PERCENTAGE' => "Percentage","FIXED" => "Fixed Amount"]])

@include('avored-framework::forms.text',['name' => 'amount','label' => __('avored-promotion::promotion.amount')])