@extends('layouts.user')

@section('breadcrumb')
<div class="flex">
    <div>
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('Home') }} >>
      </a>
    </div>
    <div class="ml-1">
      <a href="{{ route('account.dashboard') }}" class="text-gray-700" title="user dashboard">
        {{ __('User Dashboard') }} >>
      </a>
    </div>
    
    <div class="ml-1 text-gray-700">
        {{ __('Show Order') }}
    </div>
</div>
@endsection


@section('content')
<div class="block mt-5">
    <div class="border rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::order.order.show.info') }}
        </div>
        <div class="p-5">
            <p>{{ __('avored::order.order.show.id')}}: <b>{{ $order->id }}</b></p>
            <p>{{ __('avored::order.order.show.payment_option')}}: <b>{{ $order->payment_option }}</b></p>
            <p>{{ __('avored::order.order.show.shipping_option')}}: <b>{{ $order->shipping_option }}</b></p>
            <p>{{ __('avored::order.order.show.created_at')}}: <b>{{ $order->created_at->format('d-M-Y') }}</b></p>    
        </div>
    </div>


   <div class="border mt-5 rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::order.order.show.product_info') }}
        </div>
        <div class="p-5">
            @php
            $total = 0;
        @endphp
        @foreach ($order->products as $product)
            <div class="flex py-3 items-center">
                <div class="w-3/6">
                    {{ $product->product->name }}
                </div>
                <div class="w-1/6">
                    {{ number_format($product->qty, 2) }}
                </div>
                <div class="w-1/6">
                    {{ $order->currency->symbol }} {{ number_format($product->product->price, 2) }}
                </div>
                <div class="w-1/6">
                    {{ $order->currency->symbol }} {{ number_format($product->tax_amount, 2) }}
                </div>
                <div class="w-1/6">
                    <div class="font-semibold">
                        {{ $order->currency->symbol }} {{ number_format($product->price * $product->qty, 2) }}
                    </div>
                </div>
            </div>
            @php
                $total += $product->price * $product->qty;
            @endphp
            <hr/>
            <div class="flex py-3 items-center">
                <div class="w-3/6">
                    
                </div>
                <div class="w-1/6">
                    
                </div>
                <div class="w-1/6">
                    
                </div>
                <div class="w-1/6">
                    Total
                </div>
                <div class="w-1/6">
                    <div class="font-semibold">
                        {{ $order->currency->symbol }} {{ number_format($total, 2) }}
                    </div>
                </div>
            </div>
        @endforeach    
        </div>
    </div>
</div>
@endsection
