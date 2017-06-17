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


                @include('mage2productadmin::product.basic-panel')
                @include('mage2productadmin::product.images')
                @include('mage2productadmin::product.inventory-panel')
                @include('mage2productadmin::product.seo-panel')
                @include('mage2productadmin::product.extra-panel')
                @include('mage2productadmin::product.attribute');

            <div class="input-field">
                {!! Form::submit("Update Product",['class' => 'btn btn-primary']) !!}
                {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.product.index').'"']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection