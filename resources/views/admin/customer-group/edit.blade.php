@extends('mage2::admin.master')
 
@section('content')

<div class="content">
	<h1>Customer Group Edit Form</h1>

	<div class="entity_add_form">
		{!! Form::model($customerGroup,array('method' => 'PATCH', 'url' => url('/admin/customer-group',$customerGroup->id)) ) !!}

		@include('mage2::admin.customer-group._edit')
		
		{!! Form::hidden('id') !!}
		
		{!! Form::close() !!}
	
	</div>
   
</div>
@endsection