@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                    <span class="title">
                        Create Role

                    </span>
            </div>
            {!! Form::open(['method' => 'post','action' =>  route('admin.role.store')]) !!}
            @include('admin.user.role._fields')
            {!! Form::submit("Create Role",['class' => 'btn btn-primary']) !!}
            {!! Form::button("cancel",['class' => 'btn ','onclick' => 'location="' . route('admin.role.index'). '"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection