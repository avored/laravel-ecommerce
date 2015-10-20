@extends('mage2::admin.master')
 
@section('content')

<div class="content">
	<h1>Attribute List</h1>
	<hr/>
        <div class="pull-right">
            <a href="{{ @url('/admin/attribute/create') }}" class="btn btn-primary" title="Add Attribute" >
                Add Attributes
            </a>
            <br/><br/>
        </div>
     @if ( !$attributes->count() )
        You have no Attrbutes
    @else

    
		<table class="table table-bordered table-hover">
	    	<tr>
	    		<th>Id</th>
	    		<th>name</th>
	    		<th>key</th>
	    		<th>type</th>
	    		<th>Edit</th>
	    		<th>Delete</th>
	    	</tr>
	     	@foreach( $attributes as $attribute)
	    	<tr>
	   			<td>{{ $attribute->id }}</td>
	   			<td>{{ $attribute->name }}</td>
	   			<td>{{ $attribute->unique_key }}</td>
	   			<td>{{ $attribute->type }}</td>
	   			<td><a href="{{ route('admin.attribute.edit',$attribute->id) }}" title="Edit">Edit</a></td>
	   			<td>
	   				{!! Form::open(array('route' => array('admin.attribute.destroy', $attribute->id),
	   									'method' => 'DELETE' , 'id' => 'deleteForm')) !!}
	   				<a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
					{!! Form::close() !!}
	   				
	   			</td>
	   		</tr>
	   		@endforeach
    	</table>
    @endif
</div>
@endsection