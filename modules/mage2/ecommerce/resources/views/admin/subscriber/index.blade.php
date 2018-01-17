@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">Subscriber List</span>
            <a style="" href="{{ route('admin.subscriber.create') }}" class="btn btn-primary float-right">
                Create Subscriber
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>

@stop