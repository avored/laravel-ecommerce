@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<h3>{{ __('orders.my_orders') }}</h3>
    @if(count($orders) <= 0)
        <p>We couldn't find any orders.</p>
    @else
        <table class="table table-striped">
            <thead>
                <th class="text-center">{{ __('orders.number') }}</th>
                <th class="text-center">{{ __('orders.shipping_method') }}</th>
                <th class="text-center">{{ __('orders.payment_method') }}</th>
                <th class="text-center">{{ __('orders.status') }}</th>
                <th>{{ __('orders.actions') }}</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="text-center">{{ $order->id }}</td>
                    <td class="text-center">{{ __('shipping.' . $order->shipping_option) }}</td>
                    <td class="text-center">{{ __('payments.' . $order->payment_option) }} </td>
                    <td class="text-center">{{ $order->orderStatus->name }}</td>
                    <td><a href="{{ route('my-account.order.view',$order->id )}}">{{ __('orders.view') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

