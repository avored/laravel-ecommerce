@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Checkout Page</h2>
            <div class="col-md-offset-1 col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Shilling Address</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'checkout.billing-address.post']) !!}

                        @include('template.text',['key' => 'first_name','label' => 'First Name'])
                        @include('template.text',['key' => 'last_name','label' => 'Last Name'])

                        @include('template.text',['key' => 'address1','label' => 'Address1'])
                        @include('template.text',['key' => 'address2','label' => 'Address2'])
                        @include('template.text',['key' => 'area','label' => 'Area'])
                        @include('template.text',['key' => 'city','label' => 'City'])
                        @include('template.text',['key' => 'state','label' => 'State'])
                        @include('template.text',['key' => 'country','label' => 'Country'])
                        @include('template.text',['key' => 'phone','label' => 'Phone'])

                        @include('template.submit',['label' => 'Continue'])

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection