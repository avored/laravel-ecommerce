@extends('layouts.app')

@section('meta_title','Create Address List Account E commerce')
@section('meta_description','Create Address List Account E commerce')

@section('content')

    <div class="row mt-3">
        <div class="col-md-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Create Address
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('my-account.address.store') }}">
                        @csrf


                        <div class="row">
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'first_name','label' => 'First Name'])
                            </div>
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'last_name','label' => 'Last Name'])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'address1','label' => 'Address1'])
                            </div>
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'address2','label' => 'Address2'])
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'city','label' => 'City'])

                            </div>
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'state','label' => 'State'])
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
                                        @foreach($countries as $countryId => $countryName)
                                            <option @if($defaultCountry == $countryId)
                                                    {{ "selected" }}
                                                    @endif
                                                    value="{{ $countryId }}">{{ $countryName }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('country_id') }}
                                        </div>
                                    @endif


                                </div>
                            </div>
                            <div class="col-6">
                                @include('partials.forms.text',['name' => 'postcode','label' => 'Post Code'])
                            </div>
                        </div>

                        @include('partials.forms.text',['name' => 'phone','label' => 'Phone'])

                        <div class="form-group">
                            <label for="phone" class="control-label">Addresss Type</label>

                            <select name="type"
                                    @if($errors->has('type'))
                                    class="is-invalid form-control"
                                    @else
                                    class="form-control"
                                    @endif
                            >
                                <option value="SHIPPING">Shipping</option>
                                <option value="BILLING">Billing</option>
                            </select>


                            @if ($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
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
