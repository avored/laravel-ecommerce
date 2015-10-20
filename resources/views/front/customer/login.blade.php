@extends('mage2::front.master')

@section('content')
<div class="col-lg-offset-2 col-md-5">
<h1>Login Here</h1>

<form method="POST" action="{!! url('/login')  !!}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    @include('mage2::front._display_errors')
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Login</button>
    </div>
</form>
</div>
@endsection
