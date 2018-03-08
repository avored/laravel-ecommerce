@extends('mage2-ecommerce::admin.layouts.app')
@section('content')
    <div class="container">
        <div class="h1">Orders</div>
        {!! $dataGrid->render() !!}
    </div>
@stop