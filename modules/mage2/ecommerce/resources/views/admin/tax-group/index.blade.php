@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Tax Group List
            <a style="" href="{{ route('admin.tax-group.create') }}" class="btn btn-primary float-right">Create
                TaxGroup</a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop