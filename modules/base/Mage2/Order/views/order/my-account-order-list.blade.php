@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-10">

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
                <table class="table table-bordered table-responsive">
                    <thead>
                    <th>ID</th>
                    <th>Shipping Option</th>
                    <th>Payment Option</th>
                    <th>Status</th>
                    <th>View</th>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->shipping_option}}</td>
                            <td>{{ $order->payment_option }}</td>
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

