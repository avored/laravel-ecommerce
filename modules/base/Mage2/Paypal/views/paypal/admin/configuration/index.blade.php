@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>Paypal Configuration List</h1>

        </div>
        <div class="clearfix"></div>

        <br/>
        <div class="paypal-form-wrapper">

            {!! Form::model($configurations, ['route' => 'admin.configuration.store']) !!}
            
            @include('template.text',['key' => 'paypal_client_id','label' => 'Paypal Client Id'])
            @include('template.text',['key' => 'paypal_client_secret','label' => 'Paypal Client Secret'])
            @include('template.select',['key' => 'paypal_payment_mode','label' => 'Payment Mode', 'options' => ['sandbox' => 'Sandbox','live' => 'Live']])
            @include('template.text',['key' => 'paypal_payment_url','label' => 'Paypal Payment Url'])
            @include('template.select',['key' => 'paypal_payment_log','label' => 'Enable Paypal Payment Log', 'options' => ['true' => 'Yes','false' => 'No']])
            @include('template.submit',['label' => 'Save Configuration'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

