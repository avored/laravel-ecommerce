@extends('layouts.app')

@section('meta_title','Edit Address List Account E commerce')
@section('meta_description','Edit Address List Account E commerce')



@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-2">
                @include('user.my-account.sidebar')
            </div>
            <div class="col-10">
                <div class="card">
                    <div class="card-header">Edit Address</div>
                    <div class="card-body">
                        <form action=" {{ route('my-account.address.update',  $address->id) }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first_name" class="control-label">First Name</label>
                                        <input id="first_name" type="text"
                                               @if($errors->has('first_name'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="first_name"
                                               value="{{ $address->first_name }}">
                                        @if ($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('first_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">Last Name</label>
                                        <input id="last_name" type="text"
                                               @if($errors->has('last_name'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="last_name"
                                               value="{{ $address->last_name }}">
                                        @if ($errors->has('last_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('last_name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address1" class="control-label">Address1</label>
                                        <input id="address1" type="text"
                                               @if($errors->has('address1'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="address1"
                                               value="{{ $address->address1 }}">
                                        @if ($errors->has('address1'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address1') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="address2" class="control-label">Address2</label>
                                        <input id="address2" type="text"
                                               @if($errors->has('address2'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="address2"
                                               value="{{ $address->address2 }}">
                                        @if ($errors->has('address2'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('address2') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="city" class="control-label">City</label>
                                        <input id="city" type="text"
                                               @if($errors->has('city'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="city"
                                               value="{{ $address->city }}">
                                        @if ($errors->has('city'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('city') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="state" class="control-label">State</label>
                                        <input id="state" type="text"
                                               @if($errors->has('state'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="state"
                                               value="{{ $address->state }}">
                                        @if ($errors->has('state'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('state') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="country" class="control-label">Country</label>
                                        <select name="country_id"
                                                @if($errors->has('country_id'))
                                                class="is-invalid form-control"
                                                @else
                                                class="form-control"
                                                @endif
                                        >
                                            @foreach($countries as $country)
                                                <option @if($address->country_id == $country->id)
                                                        {{ "selected" }}
                                                        @endif
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('country_id'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="postcode" class="control-label">Post Code</label>
                                        <input id="postcode" type="text"
                                               @if($errors->has('postcode'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               name="postcode"
                                               value="{{ $address->postcode }}">
                                        @if ($errors->has('postcode'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('postcode') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input id="phone" type="text"
                                       @if($errors->has('phone'))
                                       class="is-invalid form-control"
                                       @else
                                       class="form-control"
                                       @endif
                                       name="phone"
                                       value="{{ $address->phone }}">
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update Address</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
