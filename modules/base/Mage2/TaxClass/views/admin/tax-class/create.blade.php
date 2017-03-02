@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Create Tax Class
                        <!--<small>Sub title</small> -->
                    </h1>
                </div>
                {!! Form::open(['route' => 'admin.tax-class.store']) !!}
                    @include('admin.tax-class._fields')

                {!! Form::submit('Create Tax class') !!}
                {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.tax-class.index').'"']) !!}

                {!! Form::close() !!}
            </div>
        </div>
@endsection