@extends('layouts.admin-bootstrap')

@section('content')

<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>Catalog Configuration List</h1>

        </div>
        <div class="clearfix"></div>

        <br/>
        <div class="paypal-form-wrapper">

            {!! Form::bind($configurations, ['action' => route('admin.configuration.store'),'method' => 'POST']) !!}
            {!! Form::text('mage2_tax_class_percentage_of_tax', 'Percentage of Tax') !!}
            
            {!! Form::submit('Save Configuration') !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

