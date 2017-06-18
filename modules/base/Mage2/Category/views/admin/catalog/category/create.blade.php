@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Category</div>
                <div class="panel-body">

                    {!! Form::open(['action' =>  route('admin.category.store'),'method' => 'POST']) !!}
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