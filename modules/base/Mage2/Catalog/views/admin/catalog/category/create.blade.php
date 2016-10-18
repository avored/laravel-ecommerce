@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Create Category</div>
                {!! Form::open(['route' => 'admin.category.store']) !!}
                @include('admin.catalog.category._fields')

                <div class="input-field">
                    {!! Form::submit("Create Category",['class' => 'btn btn-primary']) !!}
                    {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.category.index'). '"']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection