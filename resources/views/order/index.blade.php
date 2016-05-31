@extends('layouts.admin.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h1>Order</h1>

            <table class="table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Payment Option</th>
                    <th>Shipping Option</th>
                </tr>
                </thead>

                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->payment_option }}</td>
                        <td>{{ $order->shipping_option }}</td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {!! $orders->render() !!}
        </div>
    </div>
@endsection
