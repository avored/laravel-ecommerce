@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>Catalog Configuration List</h1>

        </div>
        <div class="clearfix"></div>

        <br/>
        <div class="paypal-form-wrapper">

            {!! Form::model($configurations, ['route' => 'admin.configuration.store']) !!}
            @include('template.text',['key' => 'mage2_tax_class_percentage_of_tax','label' => 'Percentage of Tax'])
            
            
            @include('template.submit',['label' => 'Save Configuration'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

