@extends('layouts.app')

@section('breadcrumb')
<nav class="text-black bg-gray-400 rounded mb-5 py-2 px-5" aria-label="Breadcrumb">
  <ol class="list-none p-0 inline-flex">
    <li class="flex items-center">
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('avored.home') }}
      </a>
      <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
    </li>
   
    <li class="flex items-center">
      <a href="#" class="text-gray-700" title="home">
        {{ __('avored.checkout_page') }}
      </a>
    </li>
   
  </ol>
</nav>
@endsection


@section('content')
  <checkout-page 
    :items="{{ Cart::toArray() }}"
    :addresses="{{ $addresses }}"
    inline-template>
    <div class="container mx-auto">
        <h1 class="text-2xl text-red-700 font-semibold my-5">
            {{ __('avored.checkout_page') }}
        </h1>
        <form 
          @submit.prevent="handleSubmit" 
            id="checkout-form"  
            method="post" 
            action="{{ route('order.place') }}"
        >
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
                      {{ __('avored.place_order') }}
                  </button>
            </div>
          </div>
        </form>
    </div>
  </checkout-page>
@endsection
