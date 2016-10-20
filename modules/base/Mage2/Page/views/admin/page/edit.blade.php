@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Edit Page
                    </h1>
                </div>

                {!! Form::model($page, ['method' => 'PUT', 'route' => ['admin.page.update', $page->id]]) !!}
                        @include('admin.page._fields')
                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update Page'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection