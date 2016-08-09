@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Register</h5>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/register','method' => 'post']) !!}

                    @include('template.text',['key' => 'first_name','label' => 'First Name'])
                    @include('template.text',['key' => 'last_name','label' => 'Last Name'])
                    @include('template.text',['key' => 'email','label' => 'Email'])
                    @include('template.password',['key' => 'password','label' => 'Password'])
                    @include('template.password',['key' => 'password_confirmation','label' => 'Confirm Password'])



                    @include('template.submit',['label' => 'Register'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection