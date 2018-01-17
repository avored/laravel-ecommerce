@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Property List</span>
            <a style="" href="{{ route('admin.property.create') }}"
               class="btn btn-primary float-right">

                Create Property
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>

@stop