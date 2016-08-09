@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Checkout Page</h2>
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment Option</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'checkout.payment-option.post']) !!}

                        @include('template.radio',['key' => 'payment_option','label' => 'Via Internet Banking'])
                        @include('template.radio',['key' => 'payment_option','label' => 'Payment on Delivery'])

                        @include('template.submit',['label' => 'Continue'])

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection