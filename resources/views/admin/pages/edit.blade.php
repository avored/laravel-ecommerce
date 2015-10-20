@extends('admin.master')
 
@section('content')

<div class="content">
	<h1>Page Edit Form</h1>

	<div class="entity_add_form">
		{!! Form::model($page,array('method' => 'PATCH', 'url' => url('/admin/pages',$page->id)) ) !!}
                
		@include('admin.pages._edit')
		{!! Form::hidden('id') !!}
		
                {!! Form::close() !!}
	
	</div>
   
</div>
@endsection