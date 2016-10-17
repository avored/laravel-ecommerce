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
                    @include('tax-class._fields')
                    @include('template.submit',['label' => 'Create TaxClass'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection