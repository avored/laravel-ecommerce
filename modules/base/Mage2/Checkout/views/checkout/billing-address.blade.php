@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Checkout Page</h2>

                <div class="panel panel-default">
                    <div class="panel-heading">Billing Address</div>
                    <div class="panel-body">
                        {!! Form::bind($address,['method' => 'post','action' => route('checkout.billing-address.post')]) !!}
                        <div class="form-group col-md-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="control-label">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $address->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="control-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $address->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group col-md-6 {{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address1" class="control-label">Address1</label>
                            <input id="address1" type="text" class="form-control" name="address1" value="{{ $address->address1 }}">
                            @if ($errors->has('address1'))
                                <span class="help-block">
                                <strong>{{ $errors->first('address1') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('address2') ? ' has-error' : '' }}">
                            <label for="address2" class="control-label">Address2</label>
                            <input id="address2" type="text" class="form-control" name="address2" value="{{ $address->address2 }}">
                            @if ($errors->has('address2'))
                                <span class="help-block">
                                <strong>{{ $errors->first('address2') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="area" class="control-label">Area</label>
                            <input id="area" type="text" class="form-control" name="area" value="{{ $address->area }}">
                            @if ($errors->has('area'))
                                <span class="help-block">
                                <strong>{{ $errors->first('area') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="control-label">City</label>
                            <input id="city" type="text" class="form-control" name="city" value="{{ $address->city }}">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="control-label">State</label>
                            <input id="state" type="text" class="form-control" name="state" value="{{ $address->state }}">
                            @if ($errors->has('state'))
                                <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="control-label">Country</label>
                            <select name="country_id" class="form-control" >
                                @foreach($countries as $country)
                                    <option @if($address->country_id == $country->id)
                                            {{ "selected" }}
                                            @endif
                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('country'))
                                <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group col-md-12 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label">Phone</label>
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $address->phone }}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>

                        {!! Form::hidden('id') !!}

                        <div class="form-group col-md-12">
                            {!! Form::submit("Continue",['class' => 'btn btn-primary']) !!}
                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>


        </div>
    </div>
</div>
@endsection