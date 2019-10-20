@extends('layouts.app')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
        {{ __('Register') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection

@section('content')
<register-fields inline-template>
    <div>
        <a-row type="flex" align="middle">
            <a-col :span="12">
                <a-row type="flex" align="middle" class="h-100 text-center">
                <a-col :span="24">
                    
                </a-col>
                </a-row>
            </a-col>
            <a-col :span="12">
                <a-row type="flex">
                <a-col :span="20" :offset="2">
                    <a-card title="Account Management">
                        <a-form
                            :form="form"
                            method="post"
                            action="{{ route('register') }}"
                            @submit="handleSubmit"
                        >
                            @csrf()
                            <a-form-item
                                @if ($errors->has('name'))
                                    validate-status="error"
                                    help="{{ $errors->first('name') }}"
                                @endif
                                label="Name">
                            <a-input
                                :auto-focus="true"
                                name="name"
                                v-decorator="[
                                'name',
                                {
                                    rules: [
                                        {   required: true, 
                                            message: 'The Name field is required' 
                                        }
                                    ]
                                }
                                ]"
                            />
                            </a-form-item>
                            <a-form-item
                                @if ($errors->has('email'))
                                    validate-status="error"
                                    help="{{ $errors->first('email') }}"
                                @endif
                                label="Email Address">
                            <a-input
                                name="email"
                                v-decorator="[
                                'email',
                                {
                                    rules: [
                                        {   required: true, 
                                            message: 'The Email field is required' 
                                        }
                                    ]
                                }
                                ]"
                            />
                            </a-form-item>
                            
                            <a-form-item 
                                @if ($errors->has('password'))
                                    validate-status="error"
                                    help="{{ $errors->first('password') }}"
                                @endif
                                label="Password">
                                <a-input
                                    name="password"
                                    type="password"
                                    v-decorator="[
                                    'password',
                                    {rules: [{ required: true, message: 'The password field is required' }]}
                                    ]"
                                />
                            </a-form-item>

                            <a-form-item 
                                @if ($errors->has('password_confirmation'))
                                    validate-status="error"
                                    help="{{ $errors->first('password_confirmation') }}"
                                @endif
                                label="Password Confirmation">
                                <a-input
                                    name="password_confirmation"
                                    type="password"
                                    v-decorator="[
                                    'password_confirmation',
                                    {rules: [{ required: true, message: 'The password confirmation field is required' }]}
                                    ]"
                                />
                            </a-form-item>
                            
                            <a-form-item>
                                <a-button
                                    type="primary"
                                    :loading="loadingSubmitBtn"
                                    html-type="submit"
                                >
                                    Register
                                </a-button>
                            </a-form-item>
                        </a-form>
                    </a-card>
                </a-col>
                </a-row>
            </a-col>
        
            
        </a-row>
    </div>
</register-fields>
@endsection
