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
    <cart-page 
        :items="{{ Cart::toArray() }}"
        cart-update-url="{{ route('cart.update') }}"
        checkout-url="{{ route('checkout.show') }}"
        :default-currency="{{ json_encode(session()->get('default_currency')) }}"
        cart-delete-url="{{ route('cart.destroy') }}">
       
    </cart-page>
@endsection
