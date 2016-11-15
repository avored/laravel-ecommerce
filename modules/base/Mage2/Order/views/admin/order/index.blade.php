@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="main-title-wrap">
            <span class="title"> Order List</span>
        </div>

        @if(count($dataGrid->data) <= 0)

        <p>Sorry No Order Found</p>

        @else
            {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

