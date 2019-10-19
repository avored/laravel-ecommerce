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
    <cart-page :items="{{ Cart::toArray() }}" cart-delete-url="{{ route('cart.destroy') }}" inline-template>
        <div>
        @php
            $currencySymbol = session()->get('default_currency')->symbol;
        @endphp
            <a-row>
                <a-col :span="2"></a-col>
                <a-col :span="4">Image</a-col>
                <a-col :span="4">Name</a-col>
                <a-col :span="3">Qty</a-col>
                <a-col :span="3">Price</a-col>
                <a-col :span="4">Tax</a-col>
                <a-col :span="4">Line Total</a-col>
            </a-row>
            <a-row class="mt-1" :key="item.slug" v-for="item in items">
                <a-col :span="2">
                    <a-checkbox @change="clickOnCheckBox($event, item)"></a-checkbox>
                </a-col>
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
                <a-col :span="3">@{{ parseFloat(item.qty).toFixed(2) }}</a-col>
                <a-col :span="3">{{ $currencySymbol }}@{{ parseFloat(item.price).toFixed(2) }}</a-col>
                <a-col :span="4">{{ $currencySymbol }}@{{ parseFloat(item.tax).toFixed(2) }}</a-col>
                <a-col :span="4">{{ $currencySymbol }}@{{ parseFloat((item.qty * item.price) + item.tax).toFixed(2) }}</a-col>
                
            </a-row>
            <a-row class="mt-1">
                <a-col :span="2"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="3"></a-col>
                <a-col :span="3"></a-col>
                <a-col :span="4">{{ __('Discount:') }}</a-col>
                <a-col :span="4">
                    {{ $currencySymbol }}{{ Cart::discount() }}
                </a-col>
            </a-row>
            <a-row class="mt-1">
                <a-col :span="2"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="4"></a-col>
                <a-col :span="3"></a-col>
                <a-col :span="3"></a-col>
                <a-col :span="4">{{ __('Grand Total:') }}</a-col>
                <a-col :span="4">
                    {{ $currencySymbol }}{{ Cart::total() }}
                </a-col>
            </a-row>
            <a-row class="mt-1">
                <a-col v-if="showCartActionBtn" :span="24">
                    <a-button type="primary">Update</a-button>
                    <a-button v-on:click="delteCartProductClick" type="dashed">Delete</a-button>
                </a-col>
            </a-row>
            <a-divider></a-divider>
            <a-row :gutter="20" class="mt-1">
                <a-col :span="12" :push="4">
                    <a-card title="Apply Promotion Code">
                        @if (Cart::discount(false) <= 0)
                        <div>
                            <form method="get" :form="form" @submit="handleCouponSubmit" action="">
                                <a-form-item label="{{ __('Enter your promotion code:') }}">
                                    <a-input :auto-focus="true" name="promotion_code"></a-input>
                                </a-form-item>
                                <a-form-item>
                                    <a-button html-type="submit" type="primary">{{ __('Apply') }}</a-button>
                                </a-form-item>
                            </form>
                        </div>
                        @else
                            {{ __('You have used one coupon already')  }}
                        @endif
                    </a-card>
                </a-col>
                <a-col :span="8" :push="4">
                    <a class="btn-checkout" href="{{ route('checkout.show') }}">
                        <a-button type="primary">{{ __('Checkout') }}</a-button>
                    </a>
                </a-col>
            </a-row>
        </div>
    </cart-page>
@endsection
