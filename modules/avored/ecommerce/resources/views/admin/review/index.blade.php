@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Review List
        </div>
        {!! $dataGrid->render() !!}
    </div>
@stop