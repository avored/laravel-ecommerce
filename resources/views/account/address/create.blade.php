@extends('layouts.user')

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <h1>{{ __('Create Address') }}</h1>
        <address-save inline-template>
        <div>
            <a-form 
                :form="form"
                method="post"
                action="{{ route('account.address.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @include('account.address._fields') 
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('Save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelAddress"
                    >
                        {{ __('Cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </address-save>
    </a-col>
</a-row>
@endsection
