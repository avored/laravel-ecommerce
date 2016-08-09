@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row profile">
    <div class="col-md-2">
        @include('default.my-account.sidebar')
    </div>
    <div class="col-md-10">
        <h3>Profile Edit</h3>
        <div class="profile-content">

            {!! Form::model($user,['route' => 'my-account.store']) !!}

            @include('template.text',['key' => 'first_name','label' => 'First Name'])
            @include('template.text',['key' => 'last_name','label' => 'Last Name'])

            @include('template.text',['key' => 'email','label' => 'Email','attributes' => ['class' => 'form-control','disabled' => true]])





            @include('template.submit',['label' => 'Edit Profile'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
    </div>
    @endsection