@extends('layouts.install')

@section('content')

    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default panel-installation center-block">
                <div class="panel-heading">Welcome to Crazy Ecommerce Installation</div>
                <div class="panel-body">
                    <h2 class="text-center">Create Admin Account</h2>

                    {{ Form::open(['route' => 'crazy.install.admin.post']) }}


                    @include('template.text',['key' => 'first_name','label' => 'First Name'])
                    @include('template.text',['key' => 'last_name','label' => 'Last Name'])
                    @include('template.text',['key' => 'email','label' => 'Email'])
                    @include('template.text',['key' => 'username','label' => 'Username'])
                    @include('template.password',['key' => 'password','label' => 'Password'])
                    @include('template.password',['key' => 'password_confirmation','label' => 'Confirm Password'])


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection