@extends('layouts.admin')
@section('header-title')
    <h1>
        Edit Product
        <!--<small>Sub title</small> -->
    </h1>
@endsection
@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.product.index') }}"><i class="fa fa-link"></i>Product</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col s12">

            {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.product.update', $product->id]]) !!}

            @include('admin.catalog.product.boxes.basic',['categories' => $categories])
            @include('admin.catalog.product.boxes.images')
            @include('admin.catalog.product.boxes.inventory')
            @include('admin.catalog.product.boxes.seo')
            <!--
            include('product.boxes.extra')
                include('admin.product._fields', ['websites' => $websites,'categories' => $categories])
            -->
            @include('template.hidden',['key' => 'id'])
            @include('template.submit',['label' => 'Update Product'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection