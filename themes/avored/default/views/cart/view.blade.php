@extends('layouts.app')

@section('meta_title','Cart Page AvoRed E commerce')
@section('meta_description','Cart Page AvoRed E commerce')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="h1">Cart Page</div>

                @if($cartProducts !== null && $cartProducts->count() > 0)

                    <table class="table table-responsive">
                        <tr>
                            <th class="col-8">Product</th>
                            <th class="col-1" style="text-align: center">Quantity</th>
                            <th class="col-1 text-center">Price</th>
                            <th class="col-1 text-center">Total</th>
                            <th class="col-1"> </th>
                        </tr>
                        <?php $total = 0; $taxTotal = 0;$giftCouponAmount = 0; ?>
                        @foreach($cartProducts as $product)

                            @include('cart._single_product', ['product', $product])

                        @endforeach


                        <tr>
                            <td class="col-8"> &nbsp; </td>
                            <td class="col-1">&nbsp;  </td>
                            <td class="col-1"> &nbsp;  </td>
                            <td class="col-1"><h6>Total</h6></td>
                            <td class="col-1 text-right"><h6>
                                    <strong>${{ number_format(($total),2) }}</strong></h6></td>
                        </tr>
                        <tr>
                            <td class="col-8">  </td>
                            <td class="col-1">  </td>
                            <td class="col-1">  </td>
                            <td class="col-1">
                                <a href="{{ route('home') }}" class="btn btn-light">
                                    <span class="oi oi-cart"></span> Continue Shopping
                                </a>
                            </td>
                            <td class="col-1 text-right">
                                <a href="{{ route('checkout.index') }}" class="btn btn-success">
                                    Checkout <span class="oi oi-play-circle"></span>
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
@endsection