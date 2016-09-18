@extends('layouts.install')

@section('content')

<div class="row">
    <div class="col s6 offset-s3">
        <div class="card center-block">
            <div class="card-content">
            <div class="card-title">Welcome to Mage2 Ecommerce Installation</div>

                <h6 class="text-center">Create Admin Account</h6>

                {{ Form::open(['route' => 'mage2.install.admin.post']) }}

                <div class="form-group col s12 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                    
                    {!! Form::label("first_name", "First Name") !!}
                    {!! Form::text('first_name',NULL,['class' => 'form-control']) !!}

                    @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col s12 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                    {!! Form::label("last_name", "Last Name") !!}

                    {!! Form::text('last_name',NULL,['class' => 'form-control']) !!}

                    @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label("email", "Email") !!}

                    {!! Form::text('email',NULL,['class' => 'form-control']) !!}

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col s12 {{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Password') !!}

                    {!! Form::password('password',['class' => 'form-control']) !!}

                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col s12 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!! Form::label('password_confirmation', 'Confirm Password') !!}

                    {!! Form::password('password_confirmation',['class' => 'form-control']) !!}

                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
               

                <div class="col s12">
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
@endsection