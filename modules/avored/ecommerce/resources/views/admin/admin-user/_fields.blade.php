

@include('mage2-ecommerce::forms.text',['name' => 'first_name','label' => __('mage2-ecommerce::user.first-name')])
@include('mage2-ecommerce::forms.text',['name' => 'last_name','label' => __('mage2-ecommerce::user.last-name')])


@include('mage2-ecommerce::forms.file',['name' => 'image','label' => __('mage2-ecommerce::user.file')])


@if($editMethod == true)
    <?php $attributes = ['disabled' => true,'class' => 'form-control','id' => 'email'];?>
@else
    <?php $attributes = ['class' => 'form-control','id' => 'email']; ?>
@endif

@include('mage2-ecommerce::forms.text',['name' => 'email','label' => __('mage2-ecommerce::user.email'),'attributes' => $attributes])



@if($editMethod == false)

    @include('mage2-ecommerce::forms.password',['name' => 'password','label' => __('mage2-ecommerce::user.password')])
    @include('mage2-ecommerce::forms.password',['name' => 'password_confirmation','label' => __('mage2-ecommerce::user.confirm-password')])

@endif


@include('mage2-ecommerce::forms.select',['name' => 'role_id','label' => __('mage2-ecommerce::user.user-role'),'options' => $roles])