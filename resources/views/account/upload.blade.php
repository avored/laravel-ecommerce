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
        {{ __('Upload') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection


@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <account-upload inline-template>
        <div>
            <a-form 
                :form="form"
                method="post"
                action="{{ route('account.save') }}"                    
                @submit="handleSubmit">

                @csrf
                
                <a-form-item
                  @if ($errors->has('file'))
                      validate-status="error"
                      help="{{ $errors->first('file') }}"
                  @endif
                  label="{{ __('Image') }}"
                >
                    <a-upload action="{{ route('account.upload.image') }}" name="file" :headers="headers" @change="handleChange" >
                        <a-button>      
                            <a-icon type="upload"></a-icon> Click to Upload
                        </a-button>
                    </a-uploa> 
                </a-form-item>
                <input type="hidden" name="image" v-model="image_path" />
                <input type="hidden" name="name" value="{{ $user->name }}" />
                
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
