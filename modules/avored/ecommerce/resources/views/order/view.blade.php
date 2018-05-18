@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-title-wrap">
                <div class='h1'>
                    Order View

                    <div class="float-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Option <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('admin.order.send-email-invoice', $order->id) }}">SendEmail
                                        Invoice</a></li>
                                <li><a class="nav-link" href="{{ route('admin.order.change-status', $order->id) }}">Change Status</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>

                <div class="card card-default">
                    <h3 class="card-header">Order Basic Info</h3>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <tr>
                                <th>Transaction No</th>
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
                                <th>Status</th>
                                <td>
                                    @if(isset($changeStatus) && $changeStatus ===true)
                                        <form action="{{ route('admin.order.update-status',$order->id) }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put">

                                            @include('avored-ecommerce::forms.select',
                                                        ['name' => 'order_status_id',
                                                        'label' => 'Order Status',
                                                        'options' => $orderStatus])


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>

                                    @else

                                        {{ $order->orderStatus->name }}
                                    @endif


                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="card-default card ">
                    <h3 class="card-header">Order Item Info</h3>

                    <div class="card-body">

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

                                        @if($product->type == "VARIATION")
                                            @foreach($order->orderProductVariation as $orderProductVariation)
                                                <p>
                                                    {{ $orderProductVariation->attribute->name }}
                                                    :
                                                    {{   $orderProductVariation->attributeDropdownOption->display_text }}
                                                </p>

                                            @endforeach
                                        @endif

                                    </td>
                                    <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                    <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                    <td> {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-default card">
                    <h3 class="card-header">Order Address Info</h3>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Shipping Info</h6>

                                <p>
                                    {{ $order->shipping_address->first_name }} {{ $order->shipping_address->last_name }}
                                    <br/>
                                    {{ $order->shipping_address->address1 }}<br/>
                                    {{ $order->shipping_address->address2 }}<br/>
                                    {{ $order->shipping_address->area }}<br/>
                                    {{ $order->shipping_address->city }}<br/>
                                    {{ $order->shipping_address->state }} {{ $order->shipping_address->country->name }}
                                    <br/>
                                    {{ $order->shipping_address->phone }}<br/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Billing Info</h6>

                                <p>
                                    {{ $order->billing_address->first_name }} {{ $order->shipping_address->last_name }}
                                    <br/>
                                    {{ $order->billing_address->address1 }}<br/>
                                    {{ $order->billing_address->address2 }}<br/>
                                    {{ $order->billing_address->area }}<br/>
                                    {{ $order->billing_address->city }}<br/>
                                    {{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}
                                    <br/>
                                    {{ $order->billing_address->phone }}<br/>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

