@extends('mage2::admin.master')
 
@section('content')

<div class="content">
	<h1>Entity Edit Form</h1>

	<div class="entity_add_form">
		{!! Form::model($entity,array('method' => 'PATCH', 'url' => url('/admin/entity',$entity->id)) ) !!}

		@include('mage2::admin.entity._edit')
		
		{!! Form::hidden('id') !!}
		
		{!! Form::close() !!}
	
	</div>
   
</div>
@endsection