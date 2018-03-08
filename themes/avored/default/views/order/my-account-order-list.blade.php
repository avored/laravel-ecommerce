@extends('layouts.app')

@section('meta_title','My Order List Account E commerce')
@section('meta_description','My Order List Account E commerce')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-9">

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
                    <!--th>Return Request</th-->
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->shipping_option}}</td>
                            <td>{{ $order->payment_option }}</td>
                            <td>{{ $order->orderStatus->name }}</td>
                            <td>
                                <a href="{{ route('my-account.order.view',$order->id )}}">View</a>
                            </td>
                            <!--td>
                                <a href=" route('my-account.order-return.create',$order->id )}}">Return Request</a>
                            </td-->


                        </tr>
                    @endforeach

                    </tbody>

                </table>
            @endif

        </div>
    </div>
@endsection

