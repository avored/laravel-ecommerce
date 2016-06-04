@extends('layouts.polymer-app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Mage2 Site</h1>
        @foreach($products as $product)

        <paper-card heading="{{ $product->title}}">
            <div class="card-content">  <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.
                I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p></div>
            <div class="card-actions">
                <a class="btn btn-primary" href="/add-to-cart/{{ $product->id }}"><paper-button>Add To Cart</a></paper-button></a>
            </div>
        </paper-card>
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
        @endforeach
        {!! $products->render() !!}
    </div>
</div>
@endsection
