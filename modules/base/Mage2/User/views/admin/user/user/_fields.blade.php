@include('template.text',['key' => 'first_name','label' => 'First Name'])
@include('template.text',['key' => 'last_name','label' => 'Last Name'])
@if($editMethod == true) 
    <?php $attributes = ['disabled' => true];?>
@else
    <?php $attributes = []; ?>
@endif

@include('template.text',['key' => 'email','label' => 'Email', 'attributes' => $attributes])
@include('template.password',['key' => 'password','label' => 'Password'])
@include('template.password',['key' => 'password_confirmation','label' => 'Confirm Password'])
