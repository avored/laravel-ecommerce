@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row mt-3">
        <div class="col-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    Create Address
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('my-account.address.store') }}">
                        {{ csrf_field() }}


                    <div class="row">
                    <div class="col-6">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="control-label">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name"
                                   value="{{ old('first_name') }}">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="control-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name"
                                   value="{{ old('last_name') }}">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label for="address1" class="control-label">Address1</label>
                                <input id="address1" type="text" class="form-control" name="address1"
                                       value="{{ old('address1') }}">
                                @if ($errors->has('address1'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <label for="address2" class="control-label">Address2</label>
                                <input id="address2" type="text" class="form-control" name="address2"
                                       value="{{ old('address2') }}">
                                @if ($errors->has('address2'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('address2') }}</strong>
                </span>
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="control-label">City</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="control-label">State</label>
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}">
                                @if ($errors->has('state'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">

                                <label for="country" class="control-label">Country</label>
                                <select name="country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option @if($defaultCountry == $country->id)
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
                        </div>
                        <div class="col-6">
                            <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                                <label for="postcode" class="control-label">Post Code</label>
                                <input id="postcode" type="text" class="form-control" name="postcode"
                                       value="{{ old('postcode') }}">
                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                    <strong>{{ $errors->first('postcode') }}</strong>
                </span>
                                @endif
                            </div>
                        </div>
                    </div>





                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="control-label">Phone</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="phone" class="control-label">Addresss Type</label>

                        <select name="type" class="form-control">
                            <option value="SHIPPING">Shipping</option>
                            <option value="BILLING">Billing</option>
                        </select>
                        @if ($errors->has('type'))
                            <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
                        @endif

                    </div>


                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="create_address" value="Create Address">
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
