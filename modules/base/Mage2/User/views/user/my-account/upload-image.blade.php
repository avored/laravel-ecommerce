@extends('layouts.app')

@section('content')
<div class="row profile">
    <div class="col-md-2">
        @include('user.my-account.sidebar')
    </div>
    <div class="col-md-10">

        <div class="panel panel-default">
            <div class="panel-heading">
                Profile Image Upload
            </div>
            <div class="panel-body">
                {!! Form::open(['action' => route('my-account.upload-image.post'), 'method' => 'post','files' => true]) !!}
                {!! Form::file('profile_image','Profile Image') !!}
                {!! Form::submit('Upload Image') !!}
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>
@endsection
