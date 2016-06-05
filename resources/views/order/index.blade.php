@extends('layouts.polymer-app')

@section('content')


<h1>Products</h1>


<div class="container">
    <div class="header layout horizontal">

        <div class="flex-1"><strong>ID</strong></div>
        <div class="flex-1"><strong>Payment Option</strong></div>
        <div class="flex-1"><strong>Shipping Option</strong></div>
        
    </div>

    @foreach($orders as $order)
    <div class="product_row layout horizontal">
        <div class="flex-1">{{ $order->id }}</div>
        <div class="flex-1">{{ $order->payment_option }}</div>
        <div class="flex-1">{{ $order->shippig_option }}</div>
        
    </div>

    @endforeach


</div>
{!! $orders->render() !!}

@endsection
