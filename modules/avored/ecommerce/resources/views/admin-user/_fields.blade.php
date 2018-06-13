

@include('avored-ecommerce::forms.text',['name' => 'first_name','label' => __('avored-ecommerce::user.first-name')])
@include('avored-ecommerce::forms.text',['name' => 'last_name','label' => __('avored-ecommerce::user.last-name')])


@include('avored-ecommerce::forms.file',['name' => 'image','label' => __('avored-ecommerce::user.file')])


@if(isset($model) && $model->email != "")
    <?php $attributes = ['disabled' => true];?>
@else
    <?php $attributes = []; ?>
@endif

@include('avored-ecommerce::forms.text',['name' => 'email',
                                        'label' => __('avored-ecommerce::user.email'),
                                        'attributes' => $attributes])

@if(!isset($model))

    @include('avored-ecommerce::forms.password',['name' => 'password','label' => __('avored-ecommerce::user.password')])
    @include('avored-ecommerce::forms.password',['name' => 'password_confirmation','label' => __('avored-ecommerce::user.confirm-password')])

@endif


@include('avored-ecommerce::forms.select',['name' => 'role_id','label' => __('avored-ecommerce::user.user-role'),'options' => $roles])