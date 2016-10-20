@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col s12">

            <div class="main-title-wrapper">
                <h1>
                    Order View

                </h1>
                <div class="right">
                    <a class='dropdown-button btn' data-constrainwidth="false" data-beloworigin="true"
                       href='#' data-activates='order-option-menu'>Options</a>

                    <!-- Dropdown Structure -->
                    <ul id='order-option-menu'  class='dropdown-content'>
                        <li><a href="{{ route('admin.order.send-email-invoice', $order->id) }}">SendEmail Invoice</a></li>
                        <li><a href="{{ route('admin.order.change-status', $order->id) }}">Change Status</a></li>
                        <!--li class="divider"></li>
                        <li><a href="#!">three</a></li-->
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>

            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Order Basic Info</h3>

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
                        <tr>
                            <th>Status</th>
                            <td>
                                @if(isset($changeStatus) && $changeStatus ===true)
                                    {!! Form::open(['method' => 'put','route' => ['admin.order.update-status',$order->id]]) !!}
                                    @include('template.select',['key' => 'order_status_id','label' => 'OrderStatus', 'options' => $orderStatus])

                                    @include('template.submit',['label' => 'Save'])
                                    {!! Form::close() !!}
                                @else
                                    {{ $order->orderStatus->title }}
                                @endif


                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="card ">
                <div class="card-content">
                    <h3 class="card-title">Order Item Info</h3>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>total</th>
                        </tr>
                        @foreach($order->products as $product)
                            <tr>

                                <td> {{ $product->id }}</td>
                                <td> {{ $product->title }}</td>
                                <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                <td> {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card">
                <div class="card-content">
                    <h3 class="card-title">Order Address Info</h3>
                    <!--div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div-->
                    <div class="row">
                        <div class="col s6">
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
                        <div class="col s6">
                            <h6>Billing Info</h6>

                            <p>
                                {{ $order->billing_address->first_name }} {{ $order->shipping_address->last_name }}
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

