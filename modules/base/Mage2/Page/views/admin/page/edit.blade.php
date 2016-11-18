@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-wrap">
                    <span class="title">
                        Edit Page
                    </span>
                </div>

                {!! Form::bind($page, ['method' => 'PUT', 'action' => route('admin.page.update', $page->id)]) !!}
                        @include('admin.page._fields')
                        

                        {!! Form::submit('Update Page') !!}
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection