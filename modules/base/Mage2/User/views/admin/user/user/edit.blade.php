@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                Edit User

            </h1>
        </div>

        {!! Form::bind($user, ['method' => 'PUT', 'action' => route('admin.user.update', $user->id)]) !!}
        @include('admin.user.user._fields',['editMethod' => true])

        @include('template.hidden',['key' => 'id'])
        {!! Form::submit("Update User",['class' => 'btn btn-primary']) !!}
        {!! Form::button("cancel",['class' => 'btn ','onclick' => 'location="' . route('admin.user.index'). '"']) !!}

        {!! Form::close() !!}
    </div>
</div>
@endsection