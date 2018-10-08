@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('user.my-account.sidebar')
    </div>
    <div class="col-md-9">
        <div class="main-title-wrapper">
            <h2>Order details</h2>
        </div>
        <div class="clearfix"></div>
        <div class="card mb-3">
            <div class="card-header">General Information</div>
            <div class="card-body">
                <table class="table">
                <tbody>
                    <tr>
                        <td>Order number</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Payment method</td>
                        <td>{{ $order->payment_option }}</td>
                    </tr>
                    <tr>
                        <td>Shipping method</td>
                        <td>{{ $order->shipping_option }}</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>

        <div class="clearfix">&nbsp;</div>

        <div class="card mb-3">
            <div class="card-header">Order Items</div>
            <div class="card-body">               
                <div class="table-responsive">

                    <form action="{{ route('my-account.order.return.post', $order->id) }}" method="post">
                        @csrf()
                    <table class="table">
                        <tbody>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            
                            <th>Reason</th>
                        </tr>
                        @foreach($order->products as $product)
                            <tr>

                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input=""
                                                name="products[{{ $product->slug }}][slug]"
                                                type="checkbox" value="{{ $product->slug }}"
                                                id="order-product-{{ $product->slug }}">
                                        
                                    </div>
                                </td>
                                <td>
                                    {{ $product->name }}

                                    @foreach($order->orderProductVariation as $orderProductVariation)
                                        <p>
                                            {{ $orderProductVariation->attribute->name }}
                                            :
                                            {{   $orderProductVariation->attributeDropdownOption->display_text }}

                                        </p>
                                        
                                    @endforeach

                                </td>
                                <td> 
                                    <div class="form-group">                  
                                        <select
                                            class="form-control"
                                            name="products[{{ $product->slug }}][qty]"
                                            >

                                            <option value="">Please Select</option>
                                            @for($i = 0; $i<$product->getRelationValue('pivot')->qty; $i++)
                                                <option value="{{ $i+1 }}">{{ $i+1 }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </td>
                                <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                <td> 
                                    <select
                                            class="form-control product-reason-dropdown"
                                            name="products[{{ $product->slug }}][reason]"
                                            >
                                        <option value="">Please Select</option>
                                        <option value="Product comes Damage">
                                            Product comes Damage
                                        </option>
                                        <option value="Never Receive">
                                            Never Received
                                        </option>
                                        <option value="Other">
                                            Other
                                        </option>
                                    </select>

                                    <div class="form-group other-reason d-none">
                                        <label>Other reason</label>
                                        <textarea
                                            name="comment"

                                            class="form-control"></textarea>
                                    </div>
                                    
                                </td>
                               
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="form-group">
                        <label>Comment</label>
                        <textarea
                            name="comment"

                            class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Order Return Request</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
        jQuery(document).on('change','.product-reason-dropdown', function(e){
            if(jQuery(this).val() == 'Other') {
                jQuery(this).parent().find('.other-reason').removeClass('d-none');
            } else {
                jQuery(this).parent().find('.other-reason').addClass('d-none');
            }
        });
    });
</script>
@endpush