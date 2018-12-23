@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<h3>Return Order #{{ $order->id }}</h3>
<div class="col-md-12">
    <p>Please select the product(s) you would like to return.</p>
    <div class="clearfix">&nbsp;</div>

    <div class="table-responsive-sm">
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