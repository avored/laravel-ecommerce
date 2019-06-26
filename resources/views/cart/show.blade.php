@extends('layouts.app')

@section('content')

     
     @foreach ($cartProducts as $cartProduct)
         <p><img src="{{ $cartProduct->image() }}" /></p>
         <p>{{ $cartProduct->name() }}</p>
         <p>{{ $cartProduct->qty() }}</p>
     @endforeach

     ${{ Cart::total() }}
@endsection
