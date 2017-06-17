@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="main-title-wrap">
            <span class="title">Create Product</span>
        </div>

    </div>
    <div class="row">
        <div class="col s12">
            {!! Form::open(['files' => true,'action' => route('admin.product.store'),'method' => 'post']) !!}

            @include('mage2productadmin::product.basic-panel' )
            @include('mage2productadmin::product.images' )
            @include('mage2productadmin::product.inventory-panel' )
            @include('mage2productadmin::product.seo-panel' )
            @include('mage2productadmin::product.extra-panel' )
            @include('mage2productadmin::product.attribute');

            {!! Form::submit('Create Product') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.product.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection