@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                <span class="title">General Configuration List</span>
            </div>
            <div class="paypal-form-wrapper">

                {!! Form::bind($configurations, ['method' => 'post','action' => route('admin.configuration.store')]) !!}

                {!! Form::text('general_site_title','Default Site Title') !!}
                {!! Form::textarea('general_site_description','Default Site Description') !!}
                {!! Form::select('general_term_condition_page', "Term & Condition Page" ,$pageOptions) !!}

                {!! Form::submit('Save Configuration') !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

