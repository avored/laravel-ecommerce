@extends('mage2-ecommerce::layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 ">
            <div class="main-title-wrap mb-3">
                <span class="h1">{{ __('mage2-address::lang.address.configuration.title') }}</span>
            </div>
            <div class="address-form-wrapper">

                {!! Form::bind($configurations, ['method' => 'post','action' => route('admin.configuration.store')]) !!}
                {!! Form::select('mage2_address_default_country', 'Select Default Country',$countries, ['class' => 'select2 form-control']) !!}
                {!! Form::submit('Save Configuration') !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(function() {
            $('#mage2_address_default_country').select2();
        })
    </script>
@endpush