@extends('layouts.app')

@section('breadcrumb')
<div class="flex">
    <div class="mr-3">
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('avored.home') }} >>
      </a>
    </div>
    <div class="text-gray-700">
        {{ __('avored.checkout') }}
    </div>
</div>
@endsection


@section('content')
  <checkout-page 
    :items="{{ Cart::toArray() }}"
    :addresses="{{ $addresses }}"
    inline-template>
    <div class="container mx-auto">
    <h1 class="text-lg text-red-700 font-semibold my-5">{{ __('avored.checkout') }} {{ __('avored.page') }}</h1>
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
                  {{ __('avored.btn.place_order') }}
              </button>
           
        </div>
      </div>
    </form>
    </div>
  </checkout-page>
@endsection
