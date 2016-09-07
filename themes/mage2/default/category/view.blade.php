@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @foreach($category->products as $product)
                <div class="col-md-4">
                    <div class="thumbnail">
                        
                        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->title }}">
                            @if(isset($product->getProductImages($first = true)->value))
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value) }}" />
                            @else 
                                <img alt="{{ $product->title }}"
                                     class="img-responsive"
                                     src="{{ asset('/img/default-product.jpg') }}" />
                            @endif
                        </a>
                        <div class="caption">
                            <h3>
                                <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->title }}">
                                {{ $product->title }}
                                </a>
                            </h3>
                            <p>
                                {{ $product->price }}
                            </p>
                            <p>
                                <a class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">Add to Cart</a>
                                @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                                    <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->id) }}">Remove from Wishlist</a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('wishlist.add', $product->id) }}">Add to Wishlist</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
