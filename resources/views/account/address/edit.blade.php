@extends('layouts.user')

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <address-save
            :address="{{ $address }}" inline-template>
        <div>
            <a-form 
                :form="form"
                method="post"
                action="{{ route('account.address.update', $address->id) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @method('put')
                @include('account.address._fields')
                
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
                        v-on:click.prevent="cancelUserGroup"
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
