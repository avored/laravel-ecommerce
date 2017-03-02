@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-wrap">
                    <span class="title">
                        Create Page
                    </span>
                </div>
                {!! Form::open(['method' => 'post','action' => route('admin.page.store')]) !!}
                        @include('mage2page::admin.page._fields')
                {!! Form::submit('Create Page') !!}
                {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.page.index').'"']) !!}
                {!! Form::close() !!}
            </div>
        </div>
@endsection