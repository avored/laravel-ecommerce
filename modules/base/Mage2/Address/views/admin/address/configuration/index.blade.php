@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>Address Configuration List</h1>

        </div>
        <div class="clearfix"></div>

        <br/>
        <div class="paypal-form-wrapper">

            {!! Form::model($configurations, ['route' => 'admin.configuration.store']) !!}
            @include('template.select',[  'key' => 'mage2_address_default_country',
                                        'label' => 'Please Select Default Country',
                                        'options' => $countries])
            
            
            @include('template.submit',['label' => 'Save Configuration'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

