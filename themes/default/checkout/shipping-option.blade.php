@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h2>Checkout Page</h2>

                <div class="col-md-offset-1 col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">Shipping Option</div>
                        <div class="panel-body">
                            {!! Form::open(['route' => 'checkout.shipping-option.post']) !!}

                            @foreach($shillingOptions as $shippingOption)

                                <div class="form-group col-md-12 {{ $errors->has($shippingOption->getIdentifier()) ? ' has-error' : '' }}">

                                    {!! Form::radio('shipping_option',$shippingOption->getIdentifier(),['class' =>'form-control','id' => $shippingOption->getIdentifier()]) !!}
                                    {!! Form::label($shippingOption->getIdentifier(), $shippingOption->getTitle() . " " . $shippingOption->getAmount()) !!}

                                    @if ($errors->has($shippingOption->getIdentifier()))
                                        <span class="help-block">
                                            <strong>{{ $errors->first($shippingOption->getIdentifier()) }}</strong>
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