@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">

                <div class="card card-default">
                    <div class="card-content">
                            <div class="card-title">
                                <h1>
                                    Edit Category
                                    <!--<small>Sub title</small> -->
                                </h1>
                            </div>
                        {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.category.update', $category->id]]) !!}
                        @include('category._fields')

                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update Category'])

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection