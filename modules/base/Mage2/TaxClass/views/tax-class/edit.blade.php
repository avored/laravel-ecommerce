@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class=" s12">
                <div class="main-title-wrapper">
                    <h1>
                        Edit TaxClass
                        <!--<small>Sub title</small> -->
                    </h1>

                </div>
                {!! Form::model($taxClass, ['method' => 'PUT', 'route' => ['admin.tax-class.update', $taxClass->id]]) !!}
                        @include('tax-class._fields')
                    
                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update TaxClass'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection