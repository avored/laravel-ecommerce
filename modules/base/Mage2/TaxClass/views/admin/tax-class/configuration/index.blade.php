@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrapper">
            <span class="title">Catalog Configuration List</span>
        </div>
        <div class="paypal-form-wrapper">

            {!! Form::bind($configurations, ['action' => route('admin.configuration.store'),'method' => 'POST']) !!}
                {!! Form::text('mage2_tax_class_percentage_of_tax', 'Percentage of Tax') !!}

                {!! Form::select('mage2_tax_class_default_country_for_tax_calculation'  , 'Default Country for Tax', $countryOptions) !!}

            {!! Form::submit('Save Configuration') !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

