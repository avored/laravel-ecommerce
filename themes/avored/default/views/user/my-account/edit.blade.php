@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')

<h3>{{ __('profile.edit_profile') }}</h3>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <p class="mb-0"><span class="fa fa-info-circle fa-lg"></span> {{ __('profile.intro') }} </p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
</div>
<div class="clearfix">&nbsp;</div>

<form method="post" action="{{ route('my-account.store') }}">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">{{ __('customer.company') }}</label>
      <input type="text" name="company_name" class="form-control" id="inputEmail4" value="{{ $user->company_name }}">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">{{ __('customer.vat') }}</label>
      <input type="text" name="tax_no" class="form-control" id="inputPassword4" value="{{ $user->tax_no }}">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="FirstName">{{ __('customer.first_name') }} <span class="text-danger">*</span></label>
      <input type="text" name="first_name" class="form-control" id="FirstName" value="{{ $user->first_name }}" required="">
    </div>
    <div class="form-group col-md-6">
      <label for="LastName">{{ __('customer.last_name') }} <span class="text-danger">*</span></label>
      <input type="text" name="last_name" class="form-control" id="LastName" value="{{ $user->last_name }}" required="">
    </div>
  </div>

  <div class="clearfix">&nbsp;</div>

  <h3>{{ __('profile.contact_details') }}</h3>
  
  <div class="form-group">
    <label for="EmailAddress">{{ __('customer.email') }} <span class="text-danger">*</span></label>
    <input type="text" name="email" class="form-control" id="EmailAddress" value="{{ $user->email }}" disabled="">
  </div>
  
  <div class="form-group">
    <label for="PhoneNumber">{{ __('customer.phone') }}</label>
    <input type="text" name="phone" class="form-control" id="PhoneNumber" value="{{ $user->phone }}" required="">
  </div>

  <button type="submit" class="btn btn-primary">{{ __('profile.update') }}</button>
</form>
@endsection
