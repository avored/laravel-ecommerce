@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>Catalog Configuration List</h1>

        </div>
        <div class="clearfix"></div>

        <br/>
        <div class="paypal-form-wrapper">

            {!! Form::model($configurations, ['route' => 'admin.configuration.store']) !!}
            @include('template.text',['key' => 'mage2_catalog_no_of_product_category_page','label' => 'No of Product in Category Page'])
            
            @include('template.select',[    'key' => 'mage2_catalog_cart_page_display_taxamount',
                                            'label' => 'Display Tax Amouny on Cart Page',
                                            'options' => ['yes' => 'Yes', 'no' => 'No']
                                    ])
            
            @include('template.submit',['label' => 'Save Configuration'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

