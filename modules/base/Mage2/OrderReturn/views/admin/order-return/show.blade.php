@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="main-title-wrap">
                <span class="title">
                    Order Return Request Show
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
                                <td>{{ $orderReturnRequest->order->id }}</td>
                            </tr>


                            <tr>
                                <th>Shipping Option</th>
                                <td>{{ $orderReturnRequest->order->shipping_option }}</td>
                            </tr>
                            <tr>
                                <th>Payment Option</th>
                                <td>{{ $orderReturnRequest->order->payment_option }}</td>
                            </tr>
                            <tr>
                                <th>Customer Phone</th>
                                <td>{{ $orderReturnRequest->order->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Customer Shipping Address</th>
                                <td>
                                    <p>
                                        {{ $orderReturnRequest->order->shipping_address->address1 }}
                                        {{ $orderReturnRequest->order->shipping_address->address2 }}
                                        {{ $orderReturnRequest->order->shipping_address->area }}
                                        {{ $orderReturnRequest->order->shipping_address->city }}
                                        {{ $orderReturnRequest->order->shipping_address->state }} {{ $orderReturnRequest->order->shipping_address->country->name }}
                                        {{ $orderReturnRequest->order->shipping_address->phone }}
                                    </p>

                                </td>
                            </tr>

                            <tr>
                                <th>Customer Billing Address</th>
                                <td>
                                    <p>
                                        {{ $orderReturnRequest->order->billing_address->address1 }}
                                        {{ $orderReturnRequest->order->billing_address->address2 }}
                                        {{ $orderReturnRequest->order->billing_address->area }}
                                        {{ $orderReturnRequest->order->billing_address->city }}
                                        {{ $orderReturnRequest->order->billing_address->state }} {{ $orderReturnRequest->order->shipping_address->country->name }}
                                        {{ $orderReturnRequest->order->billing_address->phone }}
                                    </p>

                                </td>
                            </tr>
                            <tr>
                                <th>User Option</th>
                                <td>{{ $orderReturnRequest->user_option }}</td>
                            </tr>

                            <tr>
                                <th>User Message</th>
                                <td>{{ $orderReturnRequest->message }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Order Products</div>
                    <div class="panel-body">
                        <form method="post" action="{{ route('my-account.order-return.store', $orderReturnRequest->order->id) }}">
                            {{ csrf_field() }}
                            @foreach($orderReturnRequest->order->products as $product)

                                <div class="col-xs-3"><img class="img-responsive" src="{{ $product->image->smallUrl }}">
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
                                        <input type="text" class="form-control input-sm" value="1">
                                    </div>
                                </div>

                            @endforeach

                            <div class="clearfix"></div>
                            <hr/>

                            @foreach($orderReturnRequest->orderReturnRequestMessages as $message)

                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ $message->user->full_name }}</div>
                                    <div class="panel-body">
                                        {{ $message->message_text }}
                                    </div>
                                </div>
                            @endforeach


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Status</label>
                                    <select class="form-control">
                                        <option value="">Please Select</option>
                                        <option value="APPROVE_RETURN_REQUEST">Approve Return Request</option>
                                        <option value="DISAPPROVE_RETURN_REQUEST">Disapprove Return Request</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Message</label>
                                    <textarea class="form-control" name="admin_message"></textarea>
                                </div>
                            </div>





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

