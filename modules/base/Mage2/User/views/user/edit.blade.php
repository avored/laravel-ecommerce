@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col s12">
                <div class="main-title-wrapper">
                    <h1>
                        Edit User
                    
                    </h1>
                </div>

                {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.user.update', $user->id]]) !!}
                        @include('user._fields')
                    
                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update User'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection