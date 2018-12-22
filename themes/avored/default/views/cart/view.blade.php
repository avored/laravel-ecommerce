@extends('layouts.app')

@section('meta_title','Cart Page AvoRed E commerce')
@section('meta_description','Cart Page AvoRed E commerce')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="h1">{{ __('order.cart_page') }} </div>

                @if($cartProducts !== null && $cartProducts->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <tr>
                                @if(Cart::hasTax())
                                    <th class="col-7">Product</th>
                                @else
                                    <th class="col-8">Product</th>
                                @endif
                                    <th class="col-1" style="text-align: center">Quantity</th>
                                    <th class="col-1 text-center">Price</th>
                                @if(Cart::hasTax())
                                    <th class="col-1 text-center">Tax</th>
                                @endif

                                    <th class="col-1 text-center">Line Total</th>
                                    <th class="col-1"> </th>
                                </tr>

                                    @foreach($cartProducts as $product)
                                        @include('cart._single_product', ['product', $product])
                                    @endforeach
                            @if(Cart::hasTax())
                                <tr>
                                    <td class="col-8">&nbsp;  </td>
                                    <td class="col-1">&nbsp;  </td>
                                    <td class="col-1"> &nbsp;  </td>
                                    <td class="col-1"> &nbsp;  </td>
                                    <td class="col-1"><h6>Tax Total</h6></td>
                                    <td class="col-1 text-right">
                                <h6>
                                    <strong>
                                        {{ Cart::taxTotal() }}
                                    </strong>
                                </h6>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="col-8">&nbsp;  </td>
                            <td class="col-1">&nbsp;  </td>
                            <td class="col-1"> &nbsp;  </td>
                            <td class="col-1"> &nbsp;  </td>
                            <td class="col-1">
                                <h6>Total</h6>
                            </td>
                            <td class="col-1 text-right">
                                <h6>
                                    <strong>{{ Cart::total() }}</strong>
                                </h6>
                            </td>
                        </tr>

                        <tr>
                            <td class="col-8">&nbsp;  </td>
                            <td class="col-1">  </td>
                            <td class="col-1"> &nbsp;</td>
                            <td class="col-1">  </td>
                            <td class="col-1">
                                <a href="{{ route('home') }}" class="btn btn-light">
                                    <span class="fa fa-shopping-cart"></span> Continue Shopping
                                </a>
                            </td>
                            <td class="col-1 text-right">
                                <a href="{{ route('checkout.index') }}" class="btn btn-success">
                                    Checkout
                                    <span class="fa fa-play-circle"></span>
                                </a>
                            </td>
                        </tr>
                    </table>
                @else
                    <p>There is no Product in Cart yet.</p>
                @endif
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection
