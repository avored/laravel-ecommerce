

@include('avored-ecommerce::forms.text',['name' => 'name', 'label' => 'Name'])
@include('avored-ecommerce::forms.text',['name' => 'code', 'label' => 'Code'])
@include('avored-ecommerce::forms.text',['name' => 'discount', 'label' => 'Discount'])
@include('avored-ecommerce::forms.text',['name' => 'start_date', 'label' => 'Start Date'])
@include('avored-ecommerce::forms.text',['name' => 'end_date', 'label' => 'End Date'])

@include('avored-ecommerce::forms.select',['name' => 'status', 'label' => 'Status','options' => ['ENABLED' => 'Enabled','DISABLED' => 'Disabled']])


