@extends('mage2::admin.master')
 
@section('content')

<div class="content">
	<h1>Entity Edit Form</h1>
		
	<div class="product_add_form">
		{!! Form::model($attribute,array('method' => 'PATCH',
                                                 'url' => url('/admin/attribute',$attribute->id)) ) !!}

		@include('mage2::admin.attribute._edit')
		
		{!! Form::hidden('id') !!}
		
		{!! Form::close() !!}
	
	</div>
</div>


<div class='custom_attribute_row hide'>
	<div class="row ">
		<div class="col-md-4 key">
			<label>Key</label>
			<input type="text" name="select[__UNIQUE__][unique_key]" class="form-control" placeholder="Key..">
		</div>
		<div class="col-md-4 value">
			<label>Value</label>
			<input type="text" name="select[__UNIQUE__][value]" class="form-control" placeholder="Value">
		</div>
		<div class="col-md-4 delete">
			<label>&nbsp;</label>
			<a href="" class="btn btn-danger form-control">Delete</a>
		</div>
	</div>
</div>
@endsection



