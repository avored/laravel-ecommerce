@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <h2>Checkout Page</h2>
                <div class="card card-default">
                    <div class="card-content">
                    <div class="card-title">Payment Option</div>
                        {!! Form::open(['route' => 'checkout.payment-option.post']) !!}

                        @foreach($paymentOptions as $paymentOption)

                            <div class="input-field {{ $errors->has($paymentOption->getIdentifier()) ? ' has-error' : '' }}">

                                {!! Form::radio('payment_option',$paymentOption->getIdentifier(),['class' =>'form-control','id' => $paymentOption->getIdentifier()]) !!}
                                {!! Form::label($paymentOption->getIdentifier(), $paymentOption->getTitle() ) !!}

                                @if ($errors->has($paymentOption->getIdentifier()))
                                    <span class="help-block">
                                            <strong>{{ $errors->first($paymentOption->getIdentifier()) }}</strong>
                                        </span>
                                @endif
                            </div>

                        @endforeach

                        <div class="input-field">
                            {!! Form::submit("Continue",['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>

            </div>
        </div>
    </div>
@endsection