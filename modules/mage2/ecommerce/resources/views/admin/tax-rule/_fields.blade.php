


@include('mage2-ecommerce::forms.text',['name' => 'name' , 'label' => 'Name'])


@include('mage2-ecommerce::forms.select',['name' => 'country_id' , 'label' => 'Country', 'options' => $countryOptions])


@include('mage2-ecommerce::forms.text',['name' => 'state_code' , 'label' => 'State Code'])
@include('mage2-ecommerce::forms.text',['name' => 'post_code' , 'label' => 'Post code'])
@include('mage2-ecommerce::forms.text',['name' => 'percentage' , 'label' => 'Percentage'])
@include('mage2-ecommerce::forms.text',['name' => 'priority' , 'label' => 'Priority'])
