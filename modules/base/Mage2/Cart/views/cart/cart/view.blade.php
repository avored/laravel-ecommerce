@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Cart Page</h2>
        @if(count($cartProducts) <= 0)
        <p>Sorry No Product Found</p>
        @else
        <table class="table table-responsive">
            <tr>
                <th class="col-md-8">Product</th>
                <th class="col-md-1" style="text-align: center">Quantity</th>
                <th class="col-md-1 ">Price</th>
                <th class="col-md-1">Total</th>
                <th class="col-md-1"> </th>
            </tr>
            <?php $total = 0; $taxTotal = 0; ?>
            @foreach($cartProducts as $product)
                <tr>
                    {!! Form::open(['method' => 'put', 'action' => route('cart.update')]) !!}
                    <td class="col-md-8">
                        <div class="media">


                            <img alt="{{ $product['title'] }}"
                                 class="img-responsive"
                                 style="height: 72px;"
                                 src="{{ asset( $product['image']) }}" />


                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ route('product.view', $product['slug'])}}">
                                        {{ $product['title'] }}

                                    </a>
                                </h4>

                                <p>Status: <span class="text-success"><strong>In Stock</strong></span></p>

                                <?php $attributeText = ""; ?>
                                @if(isset($product['attributes']) && count($product['attributes']) > 0)
                                    @foreach($product['attributes'] as $attribute)
                                        @if($loop->last)
                                        <?php $attributeText .= $attribute['variation_display_text']; ?>
                                            @else
                                            <?php $attributeText .= $attribute['variation_display_text'] . ": "; ?>
                                        @endif
                                    @endforeach
                                @endif
                                <p>Attributes: <span class="text-success"><strong>{{ $attributeText}}</strong></span></p>

                            </div>
                        </div>
                    </td>
                    <td class="col-md-1">
                        <input type="text" class="form-control" name="qty"
                               value="{{ $product['qty']}}">

                        <input type="hidden" name="id" value="{{$product['id']}}" />
                    </td>
                    <?php $total += ($product['price'] * $product['qty'] ) ?>
                    <?php $taxTotal += ($product['tax_amount'] * $product['qty'] ) ?>
                    <td class="col-sm-1 col-md-1 text-center"><strong>${{ $product['price']}}</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong>${{ ($product['price'] * $product['qty'] )}}</strong></td>
                    <td class="col-sm-1 col-md-1">
                        <div class="btn-group">
                            <a  class="btn btn-warning" href="#" 
                                
                                onclick="x = jQuery(this);jQuery(this).parents('form:first').submit()" >
                                Update
                            </a>
                            <button type="button"
                                    class="btn dropdown-toggle"
                                    data-toggle="dropdown" >
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li> <a class="btn" href="{{ route('cart.destroy', $product['id'])}}" >
                                        Remove
                                    </a></li>
                            </ul>
                        </div>

                    </td>
                    {!! Form::close() !!}
                </tr>
                @endforeach

                <tr >
                    <td class="col-md-8"> &nbsp;  </td>
                    <td class="col-md-1">&nbsp;   </td>
                    <td class="col-md-1"> &nbsp;   </td>
                    <td class="col-md-1"><h6>Subtotal</h6></td>
                    <td class="col-md-1 text-right"><h6><strong>${{ $total }}</strong></h6></td>
                </tr>
                <tr >
                    <td class="col-md-8">   </td>
                    <td class="col-md-1">   </td>
                    <td class="col-md-1">   </td>
                    <td class="col-md-1"><h6>Tax</h6></td>
                    <td class="col-md-1 text-right"><h6><strong>${{ number_format($taxTotal,2) }}</strong></h6></td>
                </tr>
                 <tr >
                    <td class="col-md-8"> &nbsp;  </td>
                    <td class="col-md-1">&nbsp;   </td>
                    <td class="col-md-1"> &nbsp;   </td>
                    <td class="col-md-1"><h6>Total</h6></td>
                    <td class="col-md-1 text-right"><h6><strong>${{ number_format(($total + $taxTotal),2) }}</strong></h6></td>
                </tr>
                <tr >
                    <td class="col-md-8">   </td>
                    <td class="col-md-1">   </td>
                    <td class="col-md-1">   </td>
                    <td class="col-md-1">
                        <a href="{{ route('home') }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a>
                    </td>
                    <td class="col-md-1 text-right">
                        <a href="{{ route('checkout.index') }}" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </a>
                    </td>
                </tr>
</table>


            @endif
        </div>
    </div>
</div>
    @endsection