@extends('layouts.install')

@section('content')


        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Welcome to Mage2 Ecommerce Installation</h1></div>
                <div class="panel-body">


                    <h4 class="text-center">Create Admin Account</h4>

                    {{ Form::open(['route' => 'mage2.install.admin.post']) }}

                    <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">

                        {!! Form::label("first_name", "First Name") !!}
                        {!! Form::text('first_name',NULL,['class' => 'form-control']) !!}

                        @if ($errors->has('first_name'))
                            <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        {!! Form::label("last_name", "Last Name") !!}

                        {!! Form::text('last_name',NULL,['class' => 'form-control']) !!}

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label("email", "Email") !!}

                        {!! Form::text('email',NULL,['class' => 'form-control']) !!}

                        @if ($errors->has('email'))
                            <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Password') !!}

                        {!! Form::password('password',['class' => 'form-control']) !!}

                        @if ($errors->has('password'))
                            <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation', 'Confirm Password') !!}

                        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                        @endif
                    </div>


                    <div class="input-field">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>

@endsection