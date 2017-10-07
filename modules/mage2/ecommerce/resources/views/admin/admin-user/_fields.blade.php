

@include('mage2-ecommerce::forms.text',['name' => 'first_name','label' => 'First Name'])
@include('mage2-ecommerce::forms.text',['name' => 'last_name','label' => 'Last Name'])


@if($editMethod == true)
    <?php $attributes = ['disabled' => true,'class' => 'form-control','id' => 'email'];?>
@else
    <?php $attributes = ['class' => 'form-control','id' => 'email']; ?>
@endif

@include('mage2-ecommerce::forms.text',['name' => 'email','label' => 'Email','attributes' => $attributes])



@if($editMethod == false)

    @include('mage2-ecommerce::forms.password',['name' => 'password','label' => 'Password'])
    @include('mage2-ecommerce::forms.password',['name' => 'password_confirmation','label' => 'Confirm Password'])

@endif


@include('mage2-ecommerce::forms.select',['name' => 'role_id','label' => 'User Role','options' => $roles])