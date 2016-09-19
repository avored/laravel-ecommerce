@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col s12">

            <div class="main-title-wrapper">
                <h1>
                    Order List
                    <!--<small>Sub title</small> -->
                </h1>
            </div>
            <div class="clearfix"></div>
            <br/>
            @if(count($orders) <= 0)

                <p>Sorry No Order Found</p>

            @else
                <table class="table table-bordered table-responsive">
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
                                <a href="{{ route('my-account.order.view',$order->id )}}">View</a>
                            </td>


                        </tr>
                    @endforeach

                    </tbody>

                </table>
            @endif

        </div>
    </div>
@endsection

