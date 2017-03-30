@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Create Tax Rule
                        <!--<small>Sub title</small> -->
                    </h1>
                </div>
                {!! Form::open(['method' => 'post','action' => route ('admin.tax-rule.store')]) !!}
                    @include('mage2taxclass::admin.tax-rule._fields')

                {!! Form::submit('Create Tax class') !!}
                {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.tax-rule.index').'"']) !!}

                {!! Form::close() !!}
            </div>
        </div>
@endsection