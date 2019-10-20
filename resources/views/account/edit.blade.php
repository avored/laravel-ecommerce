@extends('layouts.user')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
      <a href="{{ route('account.dashboard') }}" title="user dashboard">
        {{ __('User Dashboard') }}
      </a>
    </a-breadcrumb-item>
    
    <a-breadcrumb-item>
        {{ __('Account Edit') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection


@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <account-save inline-template>
        <div>
            <a-form 
                :form="form"
                method="post"
                action="{{ route('account.save') }}"                    
                @submit="handleSubmit">

                @csrf
                
                <a-form-item
                  @if ($errors->has('name'))
                      validate-status="error"
                      help="{{ $errors->first('name') }}"
                  @endif
                  label="{{ __('Name') }}"
              >
                  <a-input
                      :auto-focus="true"
                      name="name"
                      v-decorator="[
                      'name',
                      {{ (isset($user)) ? "{'initialValue': '". $user->name ."'}," : "" }}
                      {rules: 
                          [
                              {   required: true, 
                                  message: '{{ __('validation.required', ['attribute' => 'name']) }}' 
                              }
                          ]
                      }
                      ]"
                  ></a-input>
                  </a-form-item>
                  <a-form-item  label="{{ __('Email Address') }}">
                    <a-input
                        disabled
                        name="email"
                        v-decorator="[
                        'email',
                        {{ (isset($user)) ? "{'initialValue': '". $user->email ."'}," : "" }}
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('validation.required', ['attribute' => 'email']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                  
                <a-form-item>
                <a-button
                    type="primary"
                    html-type="submit"
                >
                    {{ __('avored::system.btn.save') }}
                </a-button>
                
                <a-button
                    class="ml-1"
                    type="default"
                    v-on:click.prevent="cancelBtnClick"
                >
                    {{ __('avored::system.btn.cancel') }}
                </a-button>
            </a-form-item>
            </a-form>
            </div>
        </address-save>
    </a-col>
</a-row>
@endsection
