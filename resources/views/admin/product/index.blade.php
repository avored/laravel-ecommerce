@extends('admin.master')
 
@section('content')
<div class="content">
	<h1>Product List</h1>
	<hr/>
        <div class="pull-right">
            <a href="{{ @url('/admin/product/create') }}" class="btn btn-primary" title="Add Product" >
                Add Product
            </a>
            <br/><br/>
        </div>
     @if ( !$products->count() )
        You have no Products
    @else
		<table class="table table-bordered table-hover">
	    	<tr>
	    		<th>Id</th>
	    		<th>name</th>
                <th>Sku</th>
                <th>Slug</th>
	    		<th>Edit</th>
	    		<th>Delete</th>
	    	</tr>
	     	@foreach( $products as $product)
	    	<tr>
	   			<td>{{ $product->id }}</td>
	   			<td>{{ $product->name }}</td>
                <td> {{ $product->sku }}</td>
                <td> {{ $product->slug }}</td>
	   			<td><a href="{{ route('admin.product.edit',$product->id) }}" title="Edit">Edit</a></td>
	   			<td>
	   				{!! Form::open(array('route' => array('admin.product.destroy', $product->id),
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