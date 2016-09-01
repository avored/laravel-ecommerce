@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row profile">
    <div class="col-md-2">
        @include('my-account.sidebar')
    </div>
    <div class="col-md-10">
        <h3>Profile Edit</h3>
        <div class="profile-content">

            {!! Form::model($user,['route' => 'my-account.store']) !!}
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" class="control-label">First Name</label>
                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                @if ($errors->has('first_name'))
                    <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" class="control-label">Last Name</label>
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                @if ($errors->has('last_name'))
                    <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">Email</label>
                <input id="email" type="text" disabled="true" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
            </div>




            <div class="form-group col-md-12">
                {!! Form::submit("Update Profile",['class' => 'btn btn-primary']) !!}
            </div>


            {!! Form::close() !!}
        </div>
    </div>
</div>
    </div>
    @endsection