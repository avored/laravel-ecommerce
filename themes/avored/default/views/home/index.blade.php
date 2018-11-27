@extends('layouts.app')

@php

    $metaTitle = (!is_null($pageModel) && $pageModel->meta_title != "") ? $pageModel->meta_title : "Home Page";
    $metaDescription = (!is_null($pageModel) && $pageModel->meta_description != "") ? $pageModel->meta_description : "Home Page";

@endphp

@section('meta_title',$metaTitle)
@section('meta_description',$metaDescription)

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-12" style="min-height: 450px">

                @if($pageModel !== null)
                    @markdown($pageModel->content)
                @else
                    <div class="h1">AvoRed E commerce</div>
                    <h6>Home Page</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
