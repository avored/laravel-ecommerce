@extends('layouts.app')

@section('meta_title','Create Address List Account E commerce')
@section('meta_description','Create Address List Account E commerce')

@section('content')

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
                        <div class="form-group">
                            <label for="first_name" class="control-label">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name"
                                   value="{{ old('first_name') }}">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name" class="control-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name"
                                   value="{{ old('last_name') }}">

                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address1" class="control-label">Address1</label>
                                <input id="address1" type="text" class="form-control" name="address1"
                                       value="{{ old('address1') }}">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address2" class="control-label">Address2</label>
                                <input id="address2" type="text" class="form-control" name="address2"
                                       value="{{ old('address2') }}">

                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city" class="control-label">City</label>
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state" class="control-label">State</label>
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}">

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">

                                <label for="country" class="control-label">Country</label>
                                <select name="country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option @if($defaultCountry == $country->id)
                                                {{ "selected" }}
                                                @endif
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="postcode" class="control-label">Post Code</label>
                                <input id="postcode" type="text" class="form-control" name="postcode"
                                       value="{{ old('postcode') }}">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="control-label">Phone</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                    </div>

                    <div class="form-group">
                        <label for="phone" class="control-label">Addresss Type</label>

                        <select name="type" class="form-control">
                            <option value="SHIPPING">Shipping</option>
                            <option value="BILLING">Billing</option>
                        </select>


                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="create_address" value="">
                            Create Address
                        </button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
