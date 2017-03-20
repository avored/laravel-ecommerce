@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="main-title-wrap col-md-12">
            <span class="title">Edit Product</span>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <?php 
            $productCategories = $product->categories()->get()->pluck('id')->toArray();
            
            ?>
            {!! Form::bind($product, ['files' => true,'method' => 'PUT', 'action' => route('admin.product.update', $product->id)]) !!}


                @include('mage2catalog::admin.catalog.product.basic-panel' )
                @include('mage2catalog::admin.catalog.product.images' )
                @include('mage2catalog::admin.catalog.product.inventory-panel' )
                @include('mage2catalog::admin.catalog.product.seo-panel' )


                @include('mage2catalog::admin.catalog.product.extra-panel' )

                @include('admin.catalog.product.attribute');
            
            <div class="input-field">
                {!! Form::submit("Update Product",['class' => 'btn btn-primary']) !!}
                {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.product.index').'"']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection