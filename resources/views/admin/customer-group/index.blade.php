@extends('mage2::admin.master')

@section('content')

<div class="content">
    <h1>Customer Group List</h1>
    <hr/>
    <div class="pull-right">
        <a href="{{ @url('/admin/customer-group/create') }}" class="btn btn-primary" title="Add Customer Group" >
            Add Customer Group
        </a>
        <br/><br/>
    </div>
    @if ( !$customerGroups->count() )
    You have no Customer Group
    @else


    <table class="table table-bordered table-hover">
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach( $customerGroups as $customerGroup)
        <tr>
            <td>{{ $customerGroup->id }}</td>
            <td>{{ $customerGroup->name }}</td>
            <td><a href="{{ route('admin.customer-group.edit',$customerGroup->id) }}" 
                   title="Edit">Edit</a></td>
            <td>
                {!! Form::open(array('route' => array('admin.customer-group.destroy', $customerGroup->id), 
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