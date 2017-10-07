@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    General Configuration List
                </div>
                <div class="card-body">

                    {!! Form::bind($configurations, ['method' => 'post','action' => route('admin.configuration.store')]) !!}

                    {!! Form::text('general_site_title','Default Site Title') !!}
                    {!! Form::textarea('general_site_description','Default Site Description') !!}
                    {!! Form::select('general_term_condition_page', "Term & Condition Page" ,$pageOptions) !!}

                    {!! Form::select('general_home_page', "Home Page" ,$pageOptions) !!}

                    {!! Form::submit('Save Configuration') !!}

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

