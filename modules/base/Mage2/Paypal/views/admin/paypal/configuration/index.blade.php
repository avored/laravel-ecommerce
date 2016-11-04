@extends('layouts.admin-bootstrap')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
            <span class="title">Paypal Configuration List</span>
        </div>
        <div class="paypal-form-wrapper">

            {!! Form::bind($configurations, ['method' => 'post','action' => route('admin.configuration.store')]) !!}
            
            {!! Form::text('paypal_client_id','Paypal Client Id') !!}
            {!! Form::text('paypal_client_secret','Paypal Client Secret') !!}
            {!! Form::select('paypal_payment_mode','Payment Mode',['sandbox' => 'Sandbox','live' => 'Live']) !!}
            {!! Form::text('paypal_payment_url','Paypal Payment Url') !!}
            {!! Form::select('paypal_payment_log','Enable Paypal Payment Log',['true' => 'Yes','false' => 'No']) !!}
            
            {!! Form::submit('Save Configuration') !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

