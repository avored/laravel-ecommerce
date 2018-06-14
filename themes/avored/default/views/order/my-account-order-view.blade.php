@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-9">

            <div class="main-title-wrapper">
                <h1>
                    Order View
                    <!--<small>Sub title</small> -->
                </h1>

            </div>
            <div class="clearfix"></div>
            <br/>

            <div class="panel">
                <div class="panel-body">
                    <h3 class="panel-heading">Order Basic Info</h3>
                  

                    <table class="table table-bordered">
                        <tr>
                            <th>Transaction No</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Method</th>
                            <td>{{ $order->shipping_method }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>{{ $order->payment_method }}</td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="panel ">
                <div class="panel-body">
                    <h3 class="panel-heading">Order Item Info</h3>
                    <!--div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div-->

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>total</th>
                            </tr>
                            @foreach($order->products as $product)
                                <tr>

                                    <td> {{ $product->id }}</td>
                                    <td>
                                        {{ $product->name }}

                                        @foreach($order->orderProductVariation as $orderProductVariation)
                                            <p>
                                                {{ $orderProductVariation->attribute->name }}
                                                :
                                                {{   $orderProductVariation->attributeDropdownOption->display_text }}

                                            </p>
                                           
                                        @endforeach

                                        @if($order->orderStatus->name == "Delivered")
                                        <div class="demo-downloadable">
                                            <a href="{{ route('my-account.product.main.download') }}" 
                                                    onclick="event.preventDefault();
                                                            document.getElementById('download-main-product-media').submit();">
                                                Download Media
                                            </a>
                                            <form id="download-main-product-media" method="post" action="{{ route('my-account.product.main.download') }}">
                                                @csrf()
                                                <input type="hidden" name="product_token" value="{{ $product->downloadable->token }}" />
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                    <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                    <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                    <td> 
                                        {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} 
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="panel">
                <div class="panel-body">
                    <h3 class="panel-heading">Order Address Info</h3>
                    <!--div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div-->
                    <div class="row">
                        <div class="col-6">
                            <h6>Shipping Info</h6>

                            <p>
                                {{ $order->shipping_address->first_name }} {{ $order->shipping_address->last_name }}
                                <br/>
                                {{ $order->shipping_address->address1 }}<br/>
                                {{ $order->shipping_address->address2 }}<br/>
                                {{ $order->shipping_address->area }}<br/>
                                {{ $order->shipping_address->city }}<br/>
                                {{ $order->shipping_address->state }} {{ $order->shipping_address->country->name }}<br/>
                                {{ $order->shipping_address->phone }}<br/>
                            </p>
                        </div>
                        <div class="col-6">
                            <h6>Billing Info</h6>

                            <p>
                                {{ $order->billing_address->first_name }} {{ $order->billing_address->last_name }}
                                <br/>
                                {{ $order->billing_address->address1 }}<br/>
                                {{ $order->billing_address->address2 }}<br/>
                                {{ $order->billing_address->area }}<br/>
                                {{ $order->billing_address->city }}<br/>
                                {{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}<br/>
                                {{ $order->billing_address->phone }}<br/>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

