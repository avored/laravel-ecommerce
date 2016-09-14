@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card card-default">
                <div class="card-content">
                <div class="card-title">Register</div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">First Name</label>
                                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>


                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="input-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="input-field">

                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
