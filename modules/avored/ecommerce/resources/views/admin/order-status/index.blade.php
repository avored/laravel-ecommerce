@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">

            <div class="h1">OrderStatus List
            <a style="" href="{{ route('admin.order-status.create') }}" class="btn btn-primary float-right">Create
                OrderStatus</a>

            </div>
            {!! $dataGrid->render() !!}

    </div>
@stop