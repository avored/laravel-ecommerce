@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-10">

            <div class="main-title-wrap">
                <span class="title">
                    Order Return Request
                    <!--<small>Sub title</small> -->
                </span>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Order Details</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>ID</th>
                                <td>{{ $order->id }}</td>
                            </tr>


                            <tr>
                                <th>Shipping Option</th>
                                <td>{{ $order->shipping_option }}</td>
                            </tr>
                            <tr>
                                <th>Payment Option</th>
                                <td>{{ $order->payment_option }}</td>
                            </tr>
                            <tr>
                                <th>Customer Phone</th>
                                <td>{{ $order->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Customer Shipping Address</th>
                                <td>
                                    <p>
                                        {{ $order->shipping_address->address1 }}
                                        {{ $order->shipping_address->address2 }}
                                        {{ $order->shipping_address->area }}
                                        {{ $order->shipping_address->city }}
                                        {{ $order->shipping_address->state }} {{ $order->shipping_address->country->name }}
                                        {{ $order->shipping_address->phone }}
                                    </p>

                                </td>
                            </tr>

                            <tr>
                                <th>Customer Billing Address</th>
                                <td>
                                    <p>
                                        {{ $order->billing_address->address1 }}
                                        {{ $order->billing_address->address2 }}
                                        {{ $order->billing_address->area }}
                                        {{ $order->billing_address->city }}
                                        {{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}
                                        {{ $order->billing_address->phone }}
                                    </p>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">Order Products</div>
                    <div class="panel-body">
                        <form method="post" action="{{ route('my-account.order-return.store', $order->id) }}">
                            {{ csrf_field() }}
                            @foreach($order->products as $product)

                                <div class="col-xs-1">
                                    <input type="checkbox" name="products[{{ $product->id }}]id">
                                </div>

                                <div class="col-xs-2"><img class="img-responsive" src="{{ $product->image->smallUrl }}">
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="product-name"><strong>{{ $product->title }}</strong></h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-6 text-right">
                                        <h6><strong>${{number_format($product->price,2) }} <span
                                                        class="text-muted">x</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control input-sm" name="products[{{ $product->id }}]qty" value="1">
                                    </div>

                                </div>

                            @endforeach

                            @if( isset($order->orderReturnRequest) &&
                                $order->orderReturnRequest->status == "INIT_REQUEST"
                                )


                                <div class="clearfix"></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="">Message</label>
                                        <textarea name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                                {!! Form::hidden('order_return_request_id', $order->orderReturnRequest->id) !!}
                            @endif

                            @if(isset($order->orderReturnRequest) && $order->orderReturnRequest->status == "APPROVE")

                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="CUSTOMER_SENT_PRODUCT">I have Sent Product</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="">Message</label>
                                        <textarea name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                                {!! Form::hidden('order_return_request_id', $order->orderReturnRequest->id) !!}
                            @endif

                            @if(!isset($order->orderReturnRequest))
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="">User Option?</label>
                                        <select name="user_option" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="REFUND">Refund</option>
                                            <option value="RETURN">Return</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="">Reason for Return</label>
                                        <textarea name="message" class="form-control"></textarea>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

