@extends('layouts.app')

@section('breadcrumb')
<div class="flex text-sm">
    <div>
      <a class="text-gray-700" href="{{ route('home') }}" title="home">
        {{ __('Home') }} >> 
      </a>
    </div>
    <div class="text-gray-700" class="pl-2">
        {{ __('Cart') }}
    </div>
</div>
@endsection

@section('content')
    <cart-page 
        :items="{{ Cart::toArray() }}"
        cart-update-url="{{ route('cart.update') }}"
        checkout-url="{{ route('checkout.show') }}"
        discount-total="{{ Cart::discount() }}"
        cart-total="{{ Cart::total() }}"
        coupon-url="/apply-promotion-code"
        :default-currency="{{ json_encode(session()->get('default_currency')) }}"
        cart-delete-url="{{ route('cart.destroy') }}">
       
    </cart-page>
@endsection
