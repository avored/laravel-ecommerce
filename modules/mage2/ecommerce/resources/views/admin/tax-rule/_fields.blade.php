


@include('mage2-ecommerce::forms.text',['name' => 'name' , 'label' => __('mage2-ecommerce::tax-rule.name')])


@include('mage2-ecommerce::forms.select',['name' => 'country_id' ,
                                            'label' => __('mage2-ecommerce::tax-rule.country'),
                                            'options' => $countryOptions])


@include('mage2-ecommerce::forms.text',['name' => 'state_code' , 'label' => __('mage2-ecommerce::tax-rule.state-code')])
@include('mage2-ecommerce::forms.text',['name' => 'post_code' , 'label' => __('mage2-ecommerce::tax-rule.post-code')])
@include('mage2-ecommerce::forms.text',['name' => 'percentage' , 'label' => __('mage2-ecommerce::tax-rule.percentage')])
@include('mage2-ecommerce::forms.text',['name' => 'priority' , 'label' => __('mage2-ecommerce::tax-rule.priority')])
