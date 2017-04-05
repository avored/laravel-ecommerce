@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
            <span class="title">
                Product Attribute List
            </span>
            <span class="pull-right">
                <a href="{{ route('admin.attribute.create') }}" title="Product Attribute Create"  class="btn btn-primary"> Create Attribute</a>
            </span>
        </div>

        @if(count($dataGrid->data) <= 0)
            <p>Sorry No Product Attribute Found</p>
        @else
            {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

