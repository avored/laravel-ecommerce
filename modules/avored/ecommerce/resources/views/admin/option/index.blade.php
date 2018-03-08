@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Option List
            <a href="{{ route('admin.option.create') }}"
               class="btn btn-primary float-right">
                Create Option
            </a>
        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop