@extends('layouts.polymer-app')

@section('content')

        <h1>Mage2 Site</h1>
    <div class="flex-horizontal flex-wrap">
        <?php $i =0 ?>
        @foreach($products as $product)
        <?php $i++; ?>
        @if($i%3 == 0)
        <div class="clearfix"></div>
        @endif
        <div class="flex3child">
        <paper-card heading="{{ $product->title}}">
            <div class="card-content">  <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.
                I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p></div>
            <div class="card-actions">
                <a class="btn btn-primary" href="/add-to-cart/{{ $product->id }}">
                    <paper-button  raised class="custom indigo">Add To Cart</a></paper-button>
                </a>
            </div>
        </paper-card>
        </div>
        
        @endforeach
       
    </div>
         {!! $products->render() !!}
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
