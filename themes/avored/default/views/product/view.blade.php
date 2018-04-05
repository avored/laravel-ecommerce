@extends('layouts.app')

@section('meta_title')
    {{ $title }}
@endsection

@section('meta_description')
    {{ $description }}
@endsection

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-4">
                @include('product.view.product-image',['imageType' => 'largeUrl'])
                </div>

            <div class="col-8">
                <h1 class="product-name">{{ $product->name }}</h1>

                <div class="product-price">
                    <span>$</span>
                    <span class="price">{{ number_format($product->price,2) }}</span>
                </div>

                    @if($product->type == 'BASIC')
                        @include('product.view.type.basic-add-to-cart')
                    @elseif($product->type == 'VARIATION' )
                        @include('product.view.type.variation-add-to-cart')
                    @endif

                <div class="float-left">
                        @if(isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                            <a class="btn btn-danger" href="{{ route('wishlist.remove', $product->slug) }}">
                                <i class="fa fa-heart"></i>
                            </a>
                        @else
                            <a class="btn btn-warning" href="{{ route('wishlist.add', $product->slug) }}">
                                <i class="fa fa-heart"></i>
                            </a>

                        @endif
                    </div>
                </div>

        </div>
        <div class="row">
            <p>&nbsp;</p>
        </div>
        <div class="row">

            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a data-toggle="tab" class="nav-link" href="#description">
                            DESCRIPTION
                        </a>
                    </li>

                    @foreach(Tabs::all('product-view') as $key => $tab)
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#{{ $key }}">
                                {{ $tab->label }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    <div id="description" class="tab-pane active">

                        <p>{!! $product->description !!}</p>
                    </div>


                    @foreach(Tabs::all('product-view') as $key => $tab)
                        @include($tab->view)
                    @endforeach
                </div>

            </div>
        </div>

    </div>
@endsection
