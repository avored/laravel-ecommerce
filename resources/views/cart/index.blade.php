@extends('layouts.polymer-app')

@section('content')

<div class="container">
    <h1>Cart</h1>

    @if(count($products) <= 0)
    <div class="header layout horizontal">
        <p>There is no Product in cart</p>
        <a href="/" class="btn btn-primary">Continue Shopping</a>
    </div>
    @else
    <div class="header layout horizontal">
        <div class="flex-1">Image</div>
        <div class="flex-1"> Title</div>
        <div class="flex-1">Price</div>
        <div class="flex-1">Qty</div>
        <div class="flex-1"></div>
    </div>
    @foreach($products as $product)
    <form action="/cart/action" method="post">
        <div class="layout horizontal">
            <div class="flex-1"> <img src="http://placehold.it/75x75" alt="{{ $product['title'] }}" /></div>
            <div class="flex-1">{{ $product['title']}}</div>
            <div class="flex-1">{{ $product['price']}}</div>
            <div class="flex-1"><input type="number" name="qty" value="{{ $product['qty'] }}" /></div>
            <div class="flex-1">
                <input type="hidden" name="id" value="{{ $product['id'] }}" />
                {{ csrf_field() }}
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete">Delete</button>
            </div>
        </div>
    </form>
    @endforeach
    <div class="layout horizontal">
        <div class="flex-1">
            <a href='/' title="continue shopping">Continue Shopping</a>
        </div>
        <div class="flex"></div>
        <div class="layout end">
            <a href='/checkout' title="checkout">Checkout</a>
        </div>
    </div>
</div>
@endif
</div>
@endsection
