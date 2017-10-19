@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Attribute Group List
            <a style="" href="{{ route('admin.attribute-group.create') }}" class="btn btn-primary float-right">Create
                AttributeGroup</a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop