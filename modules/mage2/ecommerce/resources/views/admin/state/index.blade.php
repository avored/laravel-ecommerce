@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            State List
            <a style="" href="{{ route('admin.state.create') }}" class="btn btn-primary float-right">Create
                State</a>
        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop