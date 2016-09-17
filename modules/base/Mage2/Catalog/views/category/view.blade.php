@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        @if(count($category->products) <= 0)
        <p>Sorry No Product Found</p>
        @else
        @foreach($category->products as $product)
        <div class="col s4">
            <div class="card card-default">
                <div class="card-content">
                    <div class="card-title">
                        <h3 style="font-size: 18px;">
                            <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->title }}">
                                {{ $product->title }}
                            </a>
                        </h3>


                        <a href="{{ route('product.view', $product->slug)}}" title="{{ $product->title }}">
                            @if(isset($product->getProductImages($first = true)->value))
                            <img alt="{{ $product->title }}"
                                 class="responsive-img"
                                 src="{{ asset('/uploads/catalog/images/'. $product->getProductImages($first= true)->value) }}" />
                            @else 
                            <img alt="{{ $product->title }}"
                                 class="responsive-img"
                                 src="{{ asset('/img/default-product.jpg') }}" />
                            @endif
                        </a>
                        <div class="caption">

                            <p>
                                {{ $product->price }}
                            </p>
                            <div class="card-action">
                                <a  href="{{ route('cart.add-to-cart', $product->id) }}" style="font-size: 15px">Add to Cart</a>
                                @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                                <a  href="{{ route('wishlist.remove', $product->id) }}"  style="font-size: 15px">Remove from Wishlist</a>
                                @else
                                <a  href="{{ route('wishlist.add', $product->id) }}"  style="font-size: 15px">Add to Wishlist</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
