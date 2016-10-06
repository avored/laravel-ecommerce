@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        <h2>Cart Page</h2>
        @if(count($cartProducts) <= 0)
        <p>Sorry No Product Found</p>
        @else
        <div class="cart-list">
            <div class="col s8">Product</div>
            <div class="col s1" style="text-align: center">Quantity</div>
            <div class="col s1 ">Price</div>
            <div class="col s1">Total</div>
            <div class="col s1"> </div>
            <?php $total = 0; ?>
            @foreach($cartProducts as $product)
            <div class="clearfix">
                <div class="col s12">

                    {!! Form::open(['method' => 'put', 'route' => 'cart.update']) !!}

                    <div class="col s8">
                        <div class="media">

                            @if(isset($product['model']->getProductImages($first = true)->value))
                            <img alt="{{ $product['model']->title }}"
                                 class="img-responsive"
                                 style="height: 72px;"
                                 src="{{ asset('/uploads/catalog/images/'. $product['model']->getProductImages($first= true)->value) }}" />
                            @else 
                            <img alt="{{ $product['model']->title }}"
                                 class="img-responsive"
                                 style="height: 72px;"
                                 src="{{ asset('/img/default-product.jpg') }}" />
                            @endif

                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ route('product.view', $product['model']->slug)}}">
                                        {{ $product['model']->title }}
                                    </a>
                                </h4>

                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="col s1">
                        <input type="text" class="form-control" name="qty"
                               value="{{ $product['qty']}}">
                        <input type="hidden" name="id" value="{{$product['model']->id}}" />
                    </div>
                    <?php $total += ($product['price'] * $product['qty'] ) ?>
                    <div class="col-sm-1 col s1 text-center"><strong>${{ $product['price']}}</strong></div>
                    <div class="col-sm-1 col s1 text-center"><strong>${{ ($product['price'] * $product['qty'] )}}</strong></div>
                    <div class="col-sm-1 col s1">
                        <a href="#" onclick="jQuery(this).parents('form:first').submit()" >
                            <span class="glyphicon glyphicon-edit"></span> Update
                        </a>
                        <a href="{{ route('cart.destroy', $product['model']->id)}}" >
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
                @endforeach
                <div class="clearfix"></div>
                <div class="col s12">
                    <div class="col s8"> &nbsp;  </div>
                    <div class="col s1">&nbsp;   </div>
                    <div class="col s1"> &nbsp;   </div>
                    <div class="col s1"><h6>Subtotal</h6></div>
                    <div class="col s1 text-right"><h6><strong>${{ $total }}</strong></h6></div>
                </div>

                <!--div class="col s12">
                    <div class="col s8">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1"><h6>Estimated shipping</h6></div>
                    <div class="col s1 text-right"><h6><strong>$0.00</strong></h6></div>
                </div-->
                <!--div class="col s12">
                    <div class="col s8">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1"><h6>Estimated shipping</h6></div>
                    <div class="col s1 text-right"><h6><strong>$0.00</strong></h6></div>
                </div-->
                <div class="col s12">
                    <div class="col s8">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1"><h6>Tax</h6></div>
                    <div class="col s1 text-right"><h6><strong>${{ "2.12" }}</strong></h6></div>
                </div>
                 <div class="col s12">
                    <div class="col s8"> &nbsp;  </div>
                    <div class="col s1">&nbsp;   </div>
                    <div class="col s1"> &nbsp;   </div>
                    <div class="col s1"><h6>Total</h6></div>
                    <div class="col s1 text-right"><h6><strong>${{ ($total + 2.12) }}</strong></h6></div>
                </div>
                <div class="col s12">
                    <div class="col s6">   </div>
                    <div class="col s1">   </div>
                    <div class="col s1">   </div>
                    <div class="col s2"> 
                        <a href="{{ route('home') }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a>
                    </div>
                    <div class="col s2 text-right"> 
                        <a href="{{ route('checkout.index') }}" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </a>
                    </div>
                </div>

            </div>

            @endif
        </div>
    </div>
</div>
    @endsection