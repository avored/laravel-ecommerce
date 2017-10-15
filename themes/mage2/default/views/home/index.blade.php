@extends('layouts.app')

@section('meta_title','Home Page')
@section('meta_description','Home Page')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="min-height: 450px">

                @if($pageModel !== null)
                    {!! $pageModel->content !!}
                @else
                <div class="h1">Mage2 E commerce</div>
                <h6>Home Page</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
