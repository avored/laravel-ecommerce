@extends('layouts.app')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </a-breadcrumb-item>
    <a-breadcrumb-item>
        {{ __('Checkout') }}
    </a-breadcrumb-item>
</a-breadcrumb>
@endsection


@section('content')
  <checkout-page 
    :items="{{ Cart::toArray() }}"
    :addresses="{{ $addresses }}"
    inline-template>
    <div>
    <h1>{{ __('Checkout Page') }}</h1>
    <a-form :form="form" @submit.prevent="handleSubmit" id="checkout-form"  method="post" action="{{ route('order.place') }}">
      @csrf          
      <a-row :gutter="15">
        <a-col :span="12">
         
              @include('checkout.cards.personal')   
          
              @include('checkout.cards.shipping-address')
              @include('checkout.cards.billing-address')
        
        </a-col>
        <a-col :span="12">
              @include('checkout.cards.shipping-option')   
              @include('checkout.cards.payment-option')   
              @include('checkout.cards.cart-items')   
              <a-form-item class="mt-1">
                <a-button
                    type="primary"
                    :loading="submitStatus"
                    html-type="submit">
                    PlaceOrder
                </a-button>
            </a-form-item>
           
        </a-col>
      </a-row>

      
    </a-form>
    </div>
  </checkout-page>
@endsection
