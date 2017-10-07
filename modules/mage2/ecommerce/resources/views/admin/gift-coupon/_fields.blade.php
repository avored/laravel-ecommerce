

@include('mage2-ecommerce::forms.text',['name' => 'name', 'label' => 'Name'])
@include('mage2-ecommerce::forms.text',['name' => 'code', 'label' => 'Code'])
@include('mage2-ecommerce::forms.text',['name' => 'discount', 'label' => 'Discount'])
@include('mage2-ecommerce::forms.text',['name' => 'start_date', 'label' => 'Start Date'])
@include('mage2-ecommerce::forms.text',['name' => 'end_date', 'label' => 'End Date'])

@include('mage2-ecommerce::forms.select',['name' => 'status', 'label' => 'Status','options' => ['ENABLED' => 'Enabled','DISABLED' => 'Disabled']])


