@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<h3>{{ __('orders.details') }}</h3>
        <div class="clearfix"></div>
        <div class="card mb-3">
            <div class="card-header">{{ __('orders.details') }}</div>
            <div class="card-body">
                <table class="table">
                <tbody>
                    <tr>
                        <td>{{ __('orders.number') }}</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('orders.payment_method') }}</td>
                        <td>{{ __('payments.' . $order->payment_option) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('orders.shipping_method') }}</td>
                        <td>{{ __('shipping.' . $order->shipping_option) }}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">{{ __('orders.shipping_details') }}</div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-6">
                        <h6>{{ __('orders.shipping_address') }}</h6>
                        <p>
                            {{ $order->shipping_address->first_name }} 
                            {{ $order->shipping_address->last_name }}
                            <br/>
                            {{ $order->shipping_address->address1 }}<br/>
                            {{ $order->shipping_address->address2 }}<br/>
                            {{ $order->shipping_address->area }}<br/>
                            {{ $order->shipping_address->city }}<br/>
                            {{ $order->shipping_address->state }} 
                            {{ $order->shipping_address->country->name }}<br/>
                            {{ $order->shipping_address->phone }}<br/>
                        </p>
                    </div>
                    <div class="col-6">
                        <h6>{{ __('orders.billing_address') }}</h6>

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

        <div class="clearfix">&nbsp;</div>

        <div class="card mb-3">
            <div class="card-header">{{ __('orders.order_items') }}</div>
            <div class="card-body">               
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <th>{{ __('orders.product_name') }}</th>
                            <th>{{ __('orders.quantity') }}</th>
                            <th>{{ __('orders.price') }}</th>
                            <th>{{ __('orders.total') }}</th>
                            <th>{{ __('orders.action') }}</th>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            @php
                                $productInfo = json_decode($product->getRelationValue('pivot')->product_info);
                            @endphp
                            <tr>
                                <td>
                                    {{ $productInfo->name }}
                                    @foreach($order->orderProductVariation as $orderProductVariation)
                                        <p>{{ $orderProductVariation->attribute->name }}
                                            :
                                            {{   $orderProductVariation->attributeDropdownOption->display_text }}
                                        </p>
                                        
                                    @endforeach

                                    @if($order->orderStatus->name == "Delivered" && $product->type === 'DOWNLOADABLE') 
                                    <div class="demo-downloadable">
                                        <a href="{{ route('my-account.product.main.download') }}" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('download-main-product-media').submit();">
                                            Download Media
                                        </a>
                                        <form i d="download-main-product-media"
                                                method="post"
                                                action="{{ route('my-account.product.main.download') }}">
                                            @csrf()
                                            <input type="hidden" name="product_token"
                                                    value="{{ $product->downloadable->token }}" />
                                        </form>
                                    </div>
                                    @endif
                                </td>
                                <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                <td> 
                                    {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} 
                                </td>
                                <td>
                                    <a href="{{ route('my-account.order.return', $order->id) }}" class="btn btn-sm btn-secondary">
                                        {{ __('orders.return_product') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

