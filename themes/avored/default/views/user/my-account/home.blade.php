@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<div class="alert alert-info">
    <h6 class="alert-heading">{{ __('my-account.welcome', ['name' => $user->first_name])}},</h6>
    <p>{{ __('my-account.intro') }}</p>
</div>

<div class="clearfix">&nbsp;</div>

<h3>{{ __('orders.recent') }}</h3>
    <table class="table table-bordered">
        <thead class="thead-light">
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
@endsection
