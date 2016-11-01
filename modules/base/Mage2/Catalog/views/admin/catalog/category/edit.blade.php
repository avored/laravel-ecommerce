@extends('layouts.admin-bootstrap')

@section('content')
        <div class="row">
            <div class="col-md-12">

                <div class="panel-default panel">
                    <div class="panel-heading">

                        Edit Category
                        <!--<small>Sub title</small> -->

                    </div>
                    <div class="panel-body">

                        {!! Mage2Form::bind($category, ['method' => 'PUT', 'action' => route('admin.category.update', $category->id)]) !!}
                        @include('admin.catalog.category._fields')

                        {!! Mage2Form::submit("Update Category",['class' => 'btn btn-primary']) !!}
                        {!! Mage2Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.category.index'). '"']) !!}
                        {!! Mage2Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection