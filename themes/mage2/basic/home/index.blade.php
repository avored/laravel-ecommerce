@extends('layouts.app')

@section('content')
<div class="row">

    @if(count($featuredProducts) <= 0)
    <p>Sorry No Feature Product</p>
    @else

    <div class="col-md-12">

        <h4>Inside Theme Featured Products</h4>
        <div class="row">
            <?php  $i =0; ?>
        @foreach($featuredProducts as $product)
            @if($i %3 == 0)
                <div class="clearfix"></div>
            @endif
            <?php $i++ ?>
        <div class="col-md-4">
            @include('catalog.product.view.product-panel',['product'=> $product])
        </div>
        @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
