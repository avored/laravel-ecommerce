


@include('mage2-ecommerce::forms.select',['name' => 'country_id','label' => "Country", 'options' => $countryOptions])

@include('mage2-ecommerce::forms.text',['name' => 'name','label' => "Name"])

@include('mage2-ecommerce::forms.text',['name' => 'code','label' => "Code"])