@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Gift Coupon List
            <a style="" href="{{ route('admin.gift-coupon.create') }}" class="btn btn-primary float-right">Create
                Gift Coupon</a>
        </div>

        {!! $dataGrid->render() !!}
    </div>
@stop