@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                Theme List
                <!--<small>Sub title</small> -->
            </h1>
            <div class="right">
                <a href="{{ route('admin.theme.create') }}"
                   class="btn btn-primary">Upload Theme</a>
            </div>
        </div>

        
        <div class="clearfix"></div>
        <br/>
        @if(count($themes) <= 0)

        <p>Sorry No Theme Found</p>

        @else
        
        <table class="table bordered tablegrid">
            <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
            </thead>
            <tbody>
                @foreach($themes as $theme)
            
                <?php $actualTheme = Theme::getByPath($theme) ?>
                <tr>
                    <td>{{ $actualTheme['name'] }}</td>
                    <td>{{ $actualTheme['description'] }}</td>
                    <td>
                        @if($activeTheme != $actualTheme['name'])
                        {!! Form::open(['method' => 'POST', 'route' => ['admin.theme.activate',$actualTheme['name']]]) !!}
                        {!! Form::hidden('active_theme_path',$actualTheme['path']) !!}
                        {!! Form::hidden('active_theme_name',$actualTheme['name']) !!}
                        <button type="submit" class="btn btn-primary">Activate</a>
                        {!! Form::close() !!}
                        @else 
                        
                        <button class="btn disabled">Active</button>
                        @endif
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
    </div>
</div>
@endsection

