@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="panel-default panel">
                <div class="panel-heading">

                    Edit Category
                    <!--<small>Sub title</small> -->

                </div>
                <div class="panel-body">

                    {!! Form::bind($category, ['method' => 'PUT', 'action' => route('admin.category.update', $category->id)]) !!}
                    @include('admin.catalog.category._fields')

                    {!! Form::submit("Update Category",['class' => 'btn btn-primary']) !!}
                    {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.category.index'). '"']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection