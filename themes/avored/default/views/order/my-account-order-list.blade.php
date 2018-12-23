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
                <th>{{ __('orders.number') }}</th>
                <th>{{ __('orders.shipping_method') }}</th>
                <th>{{ __('orders.payment_method') }}</th>
                <th>{{ __('orders.status') }}</th>
                <th>{{ __('orders.actions') }}</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ __('shipping.' . $order->shipping_option) }}</td>
                    <td>{{ __('payments.' . $order->payment_option) }} </td>
                    <td>{{ $order->orderStatus->name }}</td>
                    <td><a href="{{ route('my-account.order.view',$order->id )}}">{{ __('orders.view') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

