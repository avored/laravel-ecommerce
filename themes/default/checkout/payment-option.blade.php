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

                        @foreach($paymentOptions as $paymentOption)

                            <div class="form-group col-md-12 {{ $errors->has($paymentOption->getIdentifier()) ? ' has-error' : '' }}">

                                {!! Form::radio('payment_option',$paymentOption->getIdentifier(),['class' =>'form-control','id' => $paymentOption->getIdentifier()]) !!}
                                {!! Form::label($paymentOption->getIdentifier(), $paymentOption->getTitle() ) !!}

                                @if ($errors->has($paymentOption->getIdentifier()))
                                    <span class="help-block">
                                            <strong>{{ $errors->first($paymentOption->getIdentifier()) }}</strong>
                                        </span>
                                @endif
                            </div>

                        @endforeach
                        @include('template.submit',['label' => 'Continue'])

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection