@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-title-wrap">
            <span class="title">
                Review List
            </span>
        </div>

        @if(count($dataGrid->data) <= 0)
            <p>Sorry No Review Found</p>
        @else
            {!! $dataGrid->render() !!}
        @endif

    </div>
</div>
@endsection

