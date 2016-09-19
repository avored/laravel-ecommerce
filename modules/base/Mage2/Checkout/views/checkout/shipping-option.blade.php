@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col s12">
                <h2>Checkout Page</h2>

                    <div class="card card-default">
                        <div class="card-content">
                        <div class="card-title">Shipping Option</div>
                            {!! Form::open(['route' => 'checkout.shipping-option.post']) !!}

                            @foreach($shillingOptions as $shippingOption)

                                <div class="input-group {{ $errors->has($shippingOption->getIdentifier()) ? ' has-error' : '' }}">

                                    {!! Form::radio('shipping_option',$shippingOption->getIdentifier(),['class' =>'form-control','id' => $shippingOption->getIdentifier()]) !!}
                                    {!! Form::label($shippingOption->getIdentifier(), $shippingOption->getTitle() . " " . $shippingOption->getAmount()) !!}

                                    @if ($errors->has($shippingOption->getIdentifier()))
                                        <span class="help-block">
                                            <strong>{{ $errors->first($shippingOption->getIdentifier()) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                            <div class="input-group">
                                {!! Form::submit("Continue",['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

            </div>
        </div>

@endsection