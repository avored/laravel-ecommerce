@extends('layouts.app-bootstrap')

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
                @foreach($cartProducts as $product)
                <tr>
                    <td>
                        <strong ><a href="#">{{ $product['model']->title }}</a></strong>

                    </td>
                    <td>
                        <input type="qty"  value="{{ $product['qty']}}">
                    </td>
                    <td><strong>${{ $product['price']}}</strong></td>
                    <td><strong>${{ ($product['price'] * $product['qty'] )}}</strong></td>

                </tr>
                @endforeach
                <tr>
                    <td>   </td>

                    <td>   </td>
                    <td><strong>Subtotal</strong></td>
                    <td class=""><strong><strong>$24.59</strong></strong></td>
                </tr>
                <tr>
                    <td>   </td>

                    <td>   </td>
                    <td><strong>Estimated shipping</strong></td>
                    <td class=""><strong><strong>$6.94</strong></strong></td>
                </tr>
                <tr>

                    <td>   </td>
                    <td>   </td>
                    <td><strong>Total</strong></td>
                    <td class=""><strong><strong>$31.53</strong></strong></td>
                </tr>
                <tr>

                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" class="btn btn-default">
                            Continue Shopping
                        </button></td>
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