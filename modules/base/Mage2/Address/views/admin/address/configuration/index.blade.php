@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                <span class="title">Address Configuration List</span>
            </div>
            <div class="address-form-wrapper">

                {!! Form::bind($configurations, ['method' => 'post','action' => route('admin.configuration.store')]) !!}
                {!! Form::select('mage2_address_default_country', 'Select Default Country',$countries) !!}
                {!! Form::submit('Save Configuration') !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

