@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <h2>Review Order</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($cartProducts as $product)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> 
                                    <img class="media-object" 
                                         src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                    <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                    <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                </div>
                            </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $product['qty']}}">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ $product['price']}}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{ ($product['price'] * $product['qty'] )}}</strong></td>

                    </tr>
                    @endforeach
                    <tr>
                        <td>   </td>

                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>

                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                    </tr>
                    <tr>

                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$31.53</strong></h3></td>
                    </tr>
                    <tr>

                        <td>   </td>
                        <td>   </td>
                        <td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                            </button></td>
                        <td>
                            <a href="{{ route('order.index') }}" class="btn btn-success">
                                PLACE ORDER <span class="glyphicon glyphicon-play"></span>
                            </a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection