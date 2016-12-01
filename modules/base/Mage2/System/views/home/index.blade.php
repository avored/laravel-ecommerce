@extends('layouts.app')

@section('content')
<div class="row">
    @if(count($featuredProducts) <= 0)
    <p>Sorry No Feature Product</p>
    @else

    <div class="col-md-12">

        <div class="main-wrap">
            <h4 class="title">Inside Module Featured Products</h4>
        </div>
        @foreach($featuredProducts as $product)
        <div class="col-md-4">
            @include('catalog.product.view.product-panel',['product'=> $product])
        </div>
        @endforeach


    </div>
    @endif
</div>
@endsection
