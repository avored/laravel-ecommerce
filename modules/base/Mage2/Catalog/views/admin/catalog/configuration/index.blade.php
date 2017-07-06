@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                <span class="title">Catalog Configuration List</span>
            </div>

            <div class="paypal-form-wrapper">

                {!! Form::bind($configurations, ['method' => 'post', 'action' => route('admin.configuration.store')]) !!}
                {!! Form::text('mage2_catalog_no_of_product_category_page', 'No of Product in Category Page') !!}

                {!! Form::select('mage2_catalog_cart_page_display_taxamount', 'Display Tax Amouny on Cart Page',['yes' => 'Yes', 'no' => 'No']) !!}
                {!! Form::submit('Save Configuration') !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

