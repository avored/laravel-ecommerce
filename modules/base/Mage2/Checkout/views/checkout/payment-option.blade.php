@extends('layouts.app-bootstrap')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Checkout Page</h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                    <div class="panel-heading">Payment Option</div>
                        {!! Form::open(['method' => 'post','action' => route('checkout.payment-option.post')]) !!}

                        @foreach($paymentOptions as $paymentOption)

                            <div class="form-group {{ $errors->has('payment_option') ? ' has-error' : '' }}">

                                {!! Form::radio('payment_option',$paymentOption->getTitle(),$paymentOption->getIdentifier(),['id' => $paymentOption->getIdentifier()]) !!}
                                

                                @if ($errors->has('payment_option'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('payment_option') }}</strong>
                                        </span>
                                @endif
                            </div>

                        @endforeach

                            {!! Form::submit("Continue") !!}

                        {!! Form::close() !!}
                    </div>

            </div>
        </div>
    </div>
@endsection