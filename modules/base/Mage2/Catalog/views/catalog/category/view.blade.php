@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(count($category->products) <= 0)
        <p>Sorry No Product Found</p>
        @else
        <?php $i =0; ?>
        @foreach($products as $product)
        <div class="col-md-4">
            @include('catalog.product.view.product-panel',['product' => $product])
        </div>
        <?php  $i++; ?>
        @if($i %3 == 0 && $i > 0)
        <div class="clearfix"></div>
        @endif
        @endforeach
        <div class="clearfix"></div>
        {!!  $products->links() !!}
        @endif
    </div>
</div>
@endsection
