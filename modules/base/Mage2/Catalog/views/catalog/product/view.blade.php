@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="item-container">
                <div class="col-md-12">
                    <div class="product col-md-4 service-image-left">
                        @include('catalog.product.view.product-image',['product' => $product])
                    </div>


                    <div class="col-md-8">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="product-price">$ {{ number_format($product->price,2) }}</div>

                        {!! Form::open(['method' => 'get','action' => route('cart.add-to-cart', $product->id)]) !!}
                        <div class="product-stock">In Stock</div>
                        <hr>
                        <div class="row">
                            
                        <div class="form-group col-md-1" style="">
                            <label>Qty</label>
                            <input type="text" name="qty" class="form-control"  value="1" />
                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="">
                            <button type="submit" class="btn btn-primary" href="{{ route('cart.add-to-cart', $product->id) }}">
                                Add to Cart
                            </button>

                            @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                                <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->id) }}">
                                    Remove from Wishlist
                                </a>
                            @else
                                <a class="btn btn-danger" href="{{ route('wishlist.add', $product->id) }}">
                                    Add to Wishlist
                                </a>

                            @endif
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12 product-info">
                    <ul class="nav nav-tabs">
                        <li class="tab active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                        <li class="tab"><a data-toggle="tab" href="#review">REVIEW</a></li>
                    </ul>

                    <div class="tab-content">
                    <div id="description" class="tab-pane active col-md-12">
                        <p>{!! $product->description !!}</p>
                    </div>

                    <div id="review" class="tab-pane">

                        <div class="review-wrapper col-md-12" >
                            @include('review.list',['product' => $product])
                            <div class="review-form-wrapper" >
                            <h1>Add Review</h1>
                            @include('review.add-review-form',['product' => $product])
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
