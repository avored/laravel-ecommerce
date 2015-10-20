@extends('mage2::admin.master')
 
@section('content')
<div class="content">
	<h1>Customer Group Add Form</h1>

    <div class="col-md-5">
            {!! Form::open(array('files' => 'true', 'url' => url('admin/customer-group'))) !!}
            @include('admin.customer-group._edit')
            {!! Form::close() !!}
	</div>
</div>
@endsection