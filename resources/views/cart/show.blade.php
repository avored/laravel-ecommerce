@extends('layouts.app')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
        {{ __('Cart') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection

@section('content')
    <cart-page  :items="{{ Cart::toArray() }}" inline-template>
        <div>
            <a-row>
                <a-col :span="4">Image</a-col>
                <a-col :span="4">Name</a-col>
                <a-col :span="4">Qty</a-col>
                <a-col :span="4">Price</a-col>
                <a-col :span="4">Tax</a-col>
                <a-col :span="4">Line Total</a-col>
            </a-row>
            <a-row class="mt-1" :key="item.slug" v-for="item in items">
                <a-col :span="4">
                    <a-avatar :style="{width:'100px', height: '100px'}" :src="item.image"></a-avatar>
                </a-col>
                <a-col :span="4">
                    <a :href="'/product/' + item.slug">
                        @{{item.name}}
                    </a>
                    <p v-for="attributeInfo in item.attributes">
                        @{{ attributeInfo['attribute_name'] }}: @{{ attributeInfo['attribute_dropdown_text'] }}
                    </p>
                </a-col>
                <a-col :span="4">@{{ parseFloat(item.qty).toFixed(2) }}</a-col>
                <a-col :span="4">$@{{ parseFloat(item.price).toFixed(2) }}</a-col>
                <a-col :span="4">$@{{ parseFloat(item.tax).toFixed(2) }}</a-col>
                <a-col :span="4">$@{{ parseFloat((item.qty * item.price) + item.tax).toFixed(2) }}</a-col>
            </a-row>
            <a-row class="mt-1">
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4">
                    ${{ Cart::total() }}
                </a-col>
            </a-row>
            <a-row  class="mt-1">
                <a-col :push="20" :span="4">
                    <a href="{{ route('checkout.show') }}">
                        <a-button type="primary">{{ __('Checkout') }}</a-button>
                    </a>
                </a-col>
            </a-row>
        </div>
    </cart-page>
@endsection
