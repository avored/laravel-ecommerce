<a-divider>
<h4 class="mt-1">{{ __('User Personal Information') }}</h4>
</a-divider>
@guest()
<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('first_name'))
                    validate-status="error"
                    help="{{ $errors->first('first_name') }}"
                @endif
                label="{{ __('First Name') }}">
            <a-input
                :auto-focus="true"
                name="first_name"
                v-decorator="[
                'first_name',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('First Name') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('last_name'))
                    validate-status="error"
                    help="{{ $errors->first('last_name') }}"
                @endif
                label="{{ __('Last Name') }}">
            <a-input
                name="last_name"
                v-decorator="[
                'last_name',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Last Name') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15">
    <a-col :span="24">
        <a-form-item
                @if ($errors->has('email'))
                    validate-status="error"
                    help="{{ $errors->first('email') }}"
                @endif
                label="{{ __('Email Address') }}">
            <a-input
                name="email"
                v-decorator="[
                'email',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Email Address') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>
<!--
<a-row :gutter="15">
    <a-col :span="24">
        <a-switch @change="newAccountSwitchChange"></a-switch> Create New Account?
    </a-col>
</a-row>
-->


<a-row v-if="newAccount" :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('password'))
                    validate-status="error"
                    help="{{ $errors->first('password') }}"
                @endif
                label="{{ __('Password') }}">
            <a-input
                name="password"
                v-decorator="[
                'password',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Password') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('password_confirmation'))
                    validate-status="error"
                    help="{{ $errors->first('password_confirmation') }}"
                @endif
                label="{{ __('Confirm Password') }}">
            <a-input
                name="password_confirmation"
                v-decorator="[
                'password_confirmation',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Confirm Password') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>
@else

<a-row :gutter="15">
    <a-col :span="24">
        <a-card title="{{ Auth()->user()->name }}">
        </a-card>
    </a-col>
</a-row>
@endGuest
