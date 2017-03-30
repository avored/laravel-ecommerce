@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class=" s12">
                <div class="main-title-wrapper">
                    <h1>
                        Edit TaxRule
                        <!--<small>Sub title</small> -->
                    </h1>

                </div>
                {!! Form::bind($taxRule, ['method' => 'PUT', 'action' => route('admin.tax-rule.update', $taxRule->id)]) !!}
                        @include('mage2taxclass::admin.tax-rule._fields')
                    {!! Form::submit('Edit') !!}
                {!! Form::close() !!}
            </div>
        </div>
@endsection