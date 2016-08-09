@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Checkout Page</h2>
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Shilling Option</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'checkout.shipping-option.post']) !!}

                        @include('template.radio',['key' => 'shipping_option','label' => 'Free Shipping ($0.00)'])
                        @include('template.radio',['key' => 'shipping_option','label' => 'DHL Shipping ($4.00)'])

                        @include('template.submit',['label' => 'Continue'])

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection