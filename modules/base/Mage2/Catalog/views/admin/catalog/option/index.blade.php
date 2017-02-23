@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
            <span class="title">
                Product Option List
            </span>
            <span class="pull-right">
                <a href="{{ route('admin.option.create') }}" title="Product Option Create"  class="btn btn-primary"> Create Option</a>
            </span>
        </div>

        @if(count($dataGrid->data) <= 0)
            <p>Sorry No OptionFound</p>
        @else
            {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

