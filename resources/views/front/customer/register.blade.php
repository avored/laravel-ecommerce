@extends('mage2::front.master')

@section('content')
<h1>Login Here</h1>
<div class="col-md-6">
	<form method="POST" action="">
	    {!! csrf_field() !!}
	
	    <div class="form-group">
	        <label>Name</label>
	        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
	    </div>
	
	    <div class="form-group">
	        <label>Email </label>
	        <input  class="form-control" type="email" name="email" value="{{ old('email') }}">
	    </div>
	
	    <div class="form-group">
	        <label>Password</label>
	        <input  class="form-control" type="password" name="password">
	    </div>
	
	    <div class="form-group">
	        <label>Confirm Password</label>
	        <input  class="form-control" type="password" name="password_confirmation">
	    </div>
		@include('mage2::front._display_errors')
	    <div>
	        <button class="btn btn-primary" type="submit">Register</button>
	    </div>
	</form>
</div>
@endsection
