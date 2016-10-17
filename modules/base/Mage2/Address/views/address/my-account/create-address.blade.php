@extends('layouts.app')

@section('content')
<div class="row profile">
    <div class="col s2">
        @include('address.my-account.sidebar')
    </div>
    <div class="col s10">
        <h3>Create Address</h3>

        <div class="profile-content">

            {!! Form::open(['route' => 'my-account.address.store']) !!}

            <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="control-label">First Name</label>
                <input id="first_name" type="text" class="form-control" name="first_name"
                       value="{{ old('first_name') }}">
                @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="control-label">Last Name</label>
                <input id="last_name" type="text" class="form-control" name="last_name"
                       value="{{ old('last_name') }}">
                @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('address1') ? ' has-error' : '' }}">
                <label for="address1" class="control-label">Address1</label>
                <input id="address1" type="text" class="form-control" name="address1"
                       value="{{ old('address1') }}">
                @if ($errors->has('address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('address2') ? ' has-error' : '' }}">
                <label for="address2" class="control-label">Address2</label>
                <input id="address2" type="text" class="form-control" name="address2"
                       value="{{ old('address2') }}">
                @if ($errors->has('address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('address2') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('area') ? ' has-error' : '' }}">
                <label for="area" class="control-label">Area</label>
                <input id="area" type="text" class="form-control" name="area" value="{{ old('area') }}">
                @if ($errors->has('area'))
                <span class="help-block">
                    <strong>{{ $errors->first('area') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('city') ? ' has-error' : '' }}">
                <label for="city" class="control-label">City</label>
                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">
                @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('state') ? ' has-error' : '' }}">
                <label for="state" class="control-label">State</label>
                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}">
                @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('country') ? ' has-error' : '' }}">

                <select name="country_id" >
                    @foreach($countries as $country)
                    <option @if(isset($address->country_id)  && $address->country_id == $country->id)
                             {{ "selected" }}
                             @endif
                             value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                <label for="country" class="control-label">Country</label>
                @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
                @endif
            </div>


            <div class="input-field{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="control-label">Phone</label>
                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>


            <div class="input-field col s12">
                {!! Form::submit("Create Address",['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection