@extends('layouts.polymer-app')

@section('content')
<div class="cotainer">
    <h1>Mage2 Site</h1>



    <?php $i = 0 ?>
    <div class="product_row  layout horizontal">
        @foreach($products as $product)
            @if(($i % 3) == 0)
    </div>
    <div class="product_row  layout horizontal">
        @endif
        <div class="product flex-1">
            <paper-card heading="{{ $product->title}}" elevation="1" fadeImage="true" preloadImage="true" image="http://placehold.it/250x250">
                <div class="card-content"><p>I am a very simple card. I am good at containing small bits of
                        information.
                        I am convenient because I require little markup to use effectively.
                     arkup to use effectively.</p>
                    <div class='price'>$ {{ $product->price }}</div>
                </div>
                <div class="card-actions">
                    <a class="btn btn-primary" href="/add-to-cart/{{ $product->id }}">
                        <paper-button raised class="custom indigo">Add To Cart
                        </paper-button>
                    </a>
                    <a class="btn btn-primary" href="/product/{{ $product->id }}">
                        <paper-button raised class="custom indigo">View
                        </paper-button>
                    </a>
                </div>
            </paper-card>
        </div>
        <?php $i++; ?>
        @endforeach
    </div>
    @include('layouts.pagination', ['paginator' => $products])
</div>
    @endsection

            <!--
            <div class="col s4">
                <div class="card">
                    <div class="card-content">
                        <a href="/product/{{$product->id}}" title="{{ $product->title}}"><span class="card-title">{{ $product->title }}</span></a>
                        <p>I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                        <div class="price"> <strong>{{ $product->price }}</strong></div>
                        <a class="btn btn-primary" href="/add-to-cart/{{ $product->id }}">Add To Cart</a>
                    </div>
                </div>

            </div>
        
        -->
