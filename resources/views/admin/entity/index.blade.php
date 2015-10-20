@extends('admin.master')
 
@section('content')

<div class="content">
	<h1>Entity List</h1>
	<hr/>
        <div class="pull-right">
            <a href="{{ @url('/admin/entity/create') }}" class="btn btn-primary" title="Add Entity" >
                Add Entity
            </a>
            <br/><br/>
        </div>
     @if ( !$entities->count() )
        You have no Entity
    @else

    
		<table class="table table-bordered table-hover">
	    	<tr>
	    		<th>Id</th>
	    		<th>name</th>
	    		<th>Edit</th>
	    		<th>Delete</th>
	    	</tr>
	     	@foreach( $entities as $entity)
	    	<tr>
	   			<td>{{ $entity->id }}</td>
	   			<td>{{ $entity->name }}</td>
	   			<td><a href="{{ route('admin.entity.edit',$entity->id) }}" title="Edit">Edit</a></td>
	   			<td>
	   				{!! Form::open(array('route' => array('admin.entity.destroy', $entity->id), 'method' => 'DELETE' , 'id' => 'deleteForm')) !!}
	   				<a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
					{!! Form::close() !!}
	   				
	   			</td>
	   		</tr>
	   		@endforeach
    	</table>
    @endif
</div>
@endsection