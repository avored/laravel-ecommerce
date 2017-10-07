@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <h1>
        <span class="main-title-wrap">Product Attribute List</span>
        <a style="" href="{{ route('admin.attribute.create') }}" class="btn btn-primary float-right">Create
            Attribute</a>
    </h1>


    {!! $dataGrid->render() !!}

@stop