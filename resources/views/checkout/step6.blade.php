@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col offset-s3 s6" >
            <form action="/checkout/step7" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h5>Your </h5>
                            <div class="col s12">
                                <div class="col s3">Image</div>
                                <div class="col s4"> Title</div>
                                <div class="col s2">Price</div>
                                <div class="col s1">Qty</div>
                                <div class="col s2"></div>
                                @foreach($products as $product)
                                <form action="/cart/action" method="post">
                                    <div class="col s12">
                                        <div class="col s3"> <img src="http://placehold.it/75x75" alt="{{ $product['title'] }}" /></div>
                                        <div class="col s4">{{ $product['title']}}</div>
                                        <div class="col s2">{{ $product['price']}}</div>
                                        <div class="col s1"><input type="number" name="qty" value="{{ $product['qty'] }}" /></div>
                                        <div class="col s2">
                                            <input type="hidden" name="id" value="{{ $product['id'] }}" />
                                            {{ csrf_field() }}
                                            <button type="submit" name="update">Update</button>
                                            <button type="submit" name="delete">Delete</button>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            </div>

                        </div> <!-- END OF SHIPPING ROW -->
                        <div class="right">
                            <button type="submit">Place Order</button>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
