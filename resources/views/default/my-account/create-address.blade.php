@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row profile">
    <div class="col-md-2">
        @include('default.my-account.sidebar')
    </div>
    <div class="col-md-10">
        <h3>Address Create</h3>
        <div class="profile-content">

            {!! Form::open(['route' => 'my-account.address.store']) !!}

            @include('template.text',['key' => 'first_name','label' => 'First Name'])
            @include('template.text',['key' => 'last_name','label' => 'Last Name'])

            @include('template.text',['key' => 'address1','label' => 'Address1'])
            @include('template.text',['key' => 'address2','label' => 'Address2'])
            @include('template.text',['key' => 'area','label' => 'Area'])
            @include('template.text',['key' => 'city','label' => 'City'])
            @include('template.text',['key' => 'state','label' => 'State'])
            @include('template.text',['key' => 'country','label' => 'Country'])
            @include('template.text',['key' => 'phone','label' => 'Phone'])





            @include('template.submit',['label' => 'Create Address'])

            {!! Form::close() !!}
        </div>
    </div>
</div>
    </div>
    @endsection