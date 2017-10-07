@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Contries List
            <a style="" href="{{ route('admin.country.create') }}" class="btn btn-primary float-right">Create
                Country</a>
        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop