@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row profile">
        <div class="col-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    Profile Image Upload
                </div>
                <div class="card-body">
                    {!! Form::open(['action' => route('my-account.upload-image.post'), 'method' => 'post','files' => true]) !!}
                    {!! Form::file('profile_image','Profile Image') !!}
                    {!! Form::submit('Upload Image') !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
