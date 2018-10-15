@extends('layouts.app')

@section('meta_title')
    {{ $title }}
@endsection

@section('meta_description')
    {{ $description }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            @include('product.view.product-image',['imageType' => 'largeUrl','extraImage' => true])
        </div>

        <div class="col-8">
            <h1 class="product-name">{{ $product->name }}</h1>
            <div class="product-price">
                <span>{{ Session::get('currency_symbol') }}</span>
                <span class="price">{{ number_format($product->price,2) }}</span>
            </div>

            @if($product->type == 'BASIC')
                @include('product.view.type.basic-add-to-cart')
            @endif

            @if($product->type == 'VARIATION' )
                @include('product.view.type.variation-add-to-cart')
            @endif

            @if($product->type == 'DOWNLOADABLE' )
                @include('product.view.type.downloadable-add-to-cart')
            @endif

            <div class="float-left">
                @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                    <a class="btn btn-danger" href="{{ route('my-account.wishlist.remove', $product->slug) }}"><i class="fa fa-heart"></i></a>
                @else
                    <a class="btn btn-warning" href="{{ route('my-account.wishlist.add', $product->slug) }}"><i class="fa fa-heart"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs tabs-bordered" id="productDetails" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab"
                    data-toggle="tab" href="#description" aria-controls="description"
                    aria-selected="true"
                >
                    Description
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" aria-controls="reviews" aria-selected="false">Reviews</a>
            </li>

            @foreach(Tabs::all('product-view') as $key => $tab)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#{{ $key }}">{{ $tab->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p>{!! markdown($product->description) !!}</p>
            </div>

            <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <p>@include("avored-review::product.review")</p>
            </div>

            @foreach(Tabs::all('product-view') as $key => $tab)
                @include($tab->view)
            @endforeach
        </div>

        <!-- include("avored-related::related.product.list") -->

    </div>
</div>
@endsection
