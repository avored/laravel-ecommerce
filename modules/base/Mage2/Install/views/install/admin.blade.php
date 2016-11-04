@extends('layouts.install')

@section('content')


        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Welcome to Mage2 Ecommerce Installation</h1></div>
                <div class="panel-body">


                    <h4 class="text-center">Create Admin Account</h4>

                    {!! Form::open(['method'=> 'post','action' => route('mage2.install.admin.post')]) !!}
                    {!! Form::text('first_name','First Name') !!}
                    {!! Form::text('last_name','Last Name') !!}
                    {!! Form::text('email','Email') !!}
                    
                    {!! Form::password('password','Password') !!}
                    {!! Form::password('password_confirmation','Confirm Password') !!}
                    
                    {!! Form::submit('Continue') !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

@endsection