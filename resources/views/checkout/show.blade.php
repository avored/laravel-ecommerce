@extends('layouts.app')

@section('breadcrumb')
<div class="flex">
    <div class="mr-3">
      <a href="{{ route('home') }}" title="home">
        {{ __('Home') }}
      </a>
    </div>
    <div>
        {{ __('Checkout') }}
    </div>
</div>
@endsection


@section('content')
  <checkout-page 
    :items="{{ Cart::toArray() }}"
    :addresses="{{ $addresses }}"
    inline-template>
    <div class="container mx-auto">
    <h1 class="text-lg text-red-700 font-semibold my-5">{{ __('Checkout Page') }}</h1>
    <form @submit.prevent="handleSubmit" id="checkout-form"  method="post" action="{{ route('order.place') }}">
      @csrf          
      <div class="flex">
        <div class="w-1/2">
         
              @include('checkout.cards.personal')   
          
              @include('checkout.cards.shipping-address')
              @include('checkout.cards.billing-address')
        
        </div>
        <div class="w-1/2 ml-3">
              @include('checkout.cards.shipping-option')   
              @include('checkout.cards.payment-option')   
              @include('checkout.cards.cart-items')   
              
              <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-semibold rounded">
                  Place Order
              </button>
           
        </div>
      </div>
    </form>
    </div>
  </checkout-page>
@endsection
