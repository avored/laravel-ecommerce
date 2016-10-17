@extends('layouts.app')

@section('content')
<div class="row profile">
    
    <div class="col s2">
        @include('address.my-account.sidebar')
    </div>
    <div class="col s10">
        <h3>Profile Edit</h3>
        <div class="profile-content">

            <form action="{{ route('my-account.store') }}" method="POST">
                {{ csrf_field() }}
           
            
            <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <label for="first_name" >First Name</label>
                <input id="first_name" type="text" value="{{ $user->first_name }}"  name="first_name" >
                @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif
            </div>
            <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                <label for="last_name" >Last Name</label>
                <input id="last_name" type="text"  value="{{ $user->last_name}}"  name="last_name" >
                @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif
            </div>

            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" >Email</label>
                <input id="email" type="text" disabled="true" value="{{ $user->email }}"  name="email" >
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>




            <div class="input-field col s12">
                {!! Form::submit("Update Profile",['class' => 'btn btn-primary']) !!}
            </div>


             </form>
        </div>
    </div>
</div>
@endsection