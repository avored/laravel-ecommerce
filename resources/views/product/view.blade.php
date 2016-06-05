@extends('layouts.polymer-app')

@section('content')

   
            <h1>Mage2 Product View</h1>
           
            <paper-card heading="{{ $product->title}}" elevation="1" fadeImage="true" preloadImage="true" >
                <div class="card-content"><p>I am a very simple card. I am good at containing small bits of
                        information.
                        I am convenient because I require little markup to use effectively.
                     arkup to use effectively.</p></div>
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
                      
                       
                   
@endsection
