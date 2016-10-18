@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">

                <div class="card card-default">
                    <div class="card-content">
                            <div class="card-title">

                                    Edit Category
                                    <!--<small>Sub title</small> -->

                            </div>
                        {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.category.update', $category->id]]) !!}
                        @include('admin.catalog.category._fields')

                        @include('template.hidden',['key' => 'id'])
                        <div class="input-field">
                            {!! Form::submit("Update Category",['class' => 'btn btn-primary']) !!}
                            {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.category.index'). '"']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection