@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                Edit User

            </h1>
        </div>

        {!! Form::bind($role, ['method' => 'PUT', 'action' => route('admin.role.update', $role->id)]) !!}
        @include('admin.user.role._fields')

        @include('template.hidden',['key' => 'id'])
        {!! Form::submit("Update Role",['class' => 'btn btn-primary']) !!}
        {!! Form::button("cancel",['class' => 'btn ','onclick' => 'location="' . route('admin.role.index'). '"']) !!}

        {!! Form::close() !!}
    </div>
</div>
@endsection