@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Cart</h1>

        @if(count($products) <= 0)
            <div class="col s12">
                <p>There is no Product in cart</p>
                <a href="/" class="btn btn-primary">Continue Shopping</a>
            </div>
        @else
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
        @endif
    </div>
</div>
@endsection
