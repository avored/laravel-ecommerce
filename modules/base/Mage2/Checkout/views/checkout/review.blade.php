@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Review Order</h2>
            <table class="table table-responsive ">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="">Price</th>
                    <th class="">Total</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $subTotal = 0;
                $taxTotal = 0;
                ?>
                @foreach($cartProducts as $product)
                    <tr>
                        <td>
                            <strong><a href="#">{{ $product['title'] }}</a></strong>

                        </td>
                        <td>
                            <strong>{{ $product['qty']}}</strong>
                        </td>
                        <td><strong>${{ $product['price']}}</strong></td>
                        <td><strong>${{ ($product['price'] * $product['qty'] )}}</strong></td>

                    </tr>
                    <?php $subTotal += ($product['price'] * $product['qty']); ?>
                    <?php $taxTotal += ($product['tax_amount'] * $product['qty'] ) ?>
                @endforeach
                <tr>
                    <td>  </td>

                    <td>  </td>
                    <td><strong>Subtotal</strong></td>
                    <td class=""><strong><strong>${{ number_format($subTotal,2) }}</strong></strong></td>
                </tr>
                <tr>
                    <td>  </td>

                    <td>  </td>
                    <td><strong>Estimated shipping</strong></td>
                    <td class=""><strong><strong>${{ number_format($shippingPrice,2) }}</strong></strong></td>
                </tr>

                <tr>
                    <td>  </td>

                    <td>  </td>
                    <td><strong>Total Tax</strong></td>
                    <td class=""><strong><strong>${{ number_format($taxTotal,2) }}</strong></strong></td>
                </tr>
                <tr>

                    <td>  </td>
                    <td>  </td>
                    <td><strong>Total</strong></td>
                    <td class=""><strong><strong>${{ number_format(($subTotal + $taxTotal + $shippingPrice) , 2) }}</strong></strong></td>
                </tr>
                <tr>

                    <td>  </td>
                    <td>  </td>
                    <td>

                    </td>
                    <td>
                        <a href="{{ route('order.index') }}" class="btn btn-success">
                            PLACE ORDER
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection