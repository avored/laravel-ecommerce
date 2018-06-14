


<avored-form-input 
    field-name="first_name"
    label="First Name" 
    field-value="{!! $model->first_name ?? "" !!}" 
    error-text="{!! $errors->first('first_name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>


<avored-form-input 
    field-name="last_name"
    label="Last Name" 
    field-value="{!! $model->last_name ?? "" !!}" 
    error-text="{!! $errors->first('last_name') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>


@include('avored-ecommerce::forms.file',['name' => 'image','label' => __('avored-ecommerce::user.file')])

<avored-form-input 
    field-name="email"
    field-type="email"
    label="Email" 
    field-value="{!! $model->email ?? "" !!}" 
    error-text="{!! $errors->first('email') !!}"
    v-bind:disabled="disabled"
    v-on:change="changeModelValue"
        >
</avored-form-input>



@if(!isset($model))

<avored-form-input 
    field-name="password"
    field-type="password"
    label="Password"  
    error-text="{!! $errors->first('password') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>

<avored-form-input 
    field-name="password_confirmation"
    field-type="password"
    label="Confirm Password"  
    error-text="{!! $errors->first('password_confirmation') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>

@endif


<avored-form-select 
    field-name="role_id"
    label="Role" 
    error-text="{!! $errors->first('role_id') !!}"
    field-options='{!! $roles !!}'
    field-value="{!! $model->role_id ?? "" !!}" 
    v-on:change="changeModelValue"
        >
</avored-form-select>
