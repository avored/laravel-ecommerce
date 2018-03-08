


@include('avored-ecommerce::forms.text',['name' => 'name' , 'label' => __('avored-ecommerce::tax-rule.name')])


@include('avored-ecommerce::forms.select',['name' => 'country_id' ,
                                            'label' => __('avored-ecommerce::tax-rule.country'),
                                            'options' => $countryOptions])


@include('avored-ecommerce::forms.text',['name' => 'state_code' , 'label' => __('avored-ecommerce::tax-rule.state-code')])
@include('avored-ecommerce::forms.text',['name' => 'post_code' , 'label' => __('avored-ecommerce::tax-rule.post-code')])
@include('avored-ecommerce::forms.text',['name' => 'percentage' , 'label' => __('avored-ecommerce::tax-rule.percentage')])
@include('avored-ecommerce::forms.text',['name' => 'priority' , 'label' => __('avored-ecommerce::tax-rule.priority')])
