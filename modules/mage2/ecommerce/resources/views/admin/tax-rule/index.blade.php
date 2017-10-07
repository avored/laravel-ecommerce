@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Tax Rules List
            <a style="" href="{{ route('admin.tax-rule.create') }}" class="btn btn-primary float-right">Create
                Tax Rule</a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop