@extends('admin.master')
 
@section('content')
<div class="content">
	<h1>Create New Page</h1>

    <div class="col-md-5">
            {!! Form::open(array('url' => url('admin/pages'))) !!}
            @include('admin.pages._edit')
            {!! Form::close() !!}
	</div>
</div>
@endsection