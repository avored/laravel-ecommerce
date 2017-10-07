@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                <span class="title">Tax Class Configuration List</span>
            </div>
            <div class="paypal-form-wrapper">

                {!! Form::bind($configurations, ['action' => route('admin.configuration.store'),'method' => 'POST']) !!}

                {!! Form::select('mage2_tax_class_default_country_for_tax_calculation'  , 'Default Country for Tax', $countryOptions) !!}

                {!! Form::submit('Save Configuration') !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

