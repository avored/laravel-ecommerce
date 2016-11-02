@extends('layouts.admin-bootstrap')


@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="main-title-wrap">
            <span class="title">
                Order List
                <!--<small>Sub title</small> -->
            </span>
        </div>
        <div class="clearfix"></div>
        <br/>
        @if(count($orders) <= 0)

        <p>Sorry No Order Found</p>

        @else
        <table class="table bordered tablegrid">
            <thead>
            <th>ID</th>
            <th>Shipping Method</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>View</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->shipping_method }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->orderStatus->title }}</td>
                    <td>
                        <a href="{{ route('admin.order.view',$order->id )}}">View</a>
                    </td>


                </tr>
                @endforeach

            </tbody>

        </table>
        @endif

    </div>
</div>
@endsection

