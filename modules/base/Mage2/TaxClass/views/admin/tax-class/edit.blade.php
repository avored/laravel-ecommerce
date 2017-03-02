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
                        @include('mage2taxclass::admin.tax-class._fields')
                    {!! Form::submit('Create') !!}
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection