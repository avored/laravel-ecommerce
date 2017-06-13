@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-23">
            <div class="main-title-wrap">
            <span class="title">
                Module List
            </span>
                <div class="pull-right">
                    <a href="{{ route('admin.module.create') }}"
                       class="btn btn-primary">Upload Module</a>
                </div>
            </div>


            <div class="clearfix"></div>
            <br/>
            @if(count($modules) <= 0)

                <p>Sorry No Module Found</p>

            @else

                <table class="table bordered tablegrid">
                    <thead>
                    <th>Identifier</th>
                    <th>Name</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($modules as $module)

                        <?php //$actualTheme = Theme::getByPath($theme) ?>
                        <tr>
                            <td>{{ $module->getIdentifier() }}</td>
                            <td>{{ $module->getName() }}</td>

                            <?php
                            $identifier = $module->getIdentifier();
                            $curruntModule = $modelModule->getModuleByIdentifier($identifier);

                            ?>
                            @if(isset($curruntModule->status ) &&
                                $curruntModule->type == "SYSTEM" &&
                                $curruntModule->status == "ACTIVE")
                                <td>
                                    <button class="disabled btn btn-primary">Uninstall</button>
                                </td>

                            @elseif(isset($curruntModule->status ) &&
                                $curruntModule->type == "COMMUNITY" &&
                                $curruntModule->status == "ACTIVE")

                                <td>
                                    {!! Form::open(['method' => 'POST', 'action' =>
                                            route('admin.module.uninstall',$identifier)]) !!}
                                    <button class="btn btn-primary">Uninstall</button>
                                    {!! Form::close() !!}
                                </td>


                            @else
                                <td>

                                    {!! Form::open(['method' => 'POST', 'action' =>
                                        route('admin.module.install',$identifier)]) !!}
                                    <button type="submit" class="btn btn-primary">Install</button>
                                    {!! Form::close() !!}

                                </td>

                        @endif

                        <!--td>{ $actualTheme['description'] }}</td>
                    <td>
                        if($activeTheme != $actualTheme['name'])
                        !! Form::open(['method' => 'POST', 'action' => 
                                    route('admin.theme.activate',$actualTheme['name'])]) !!}
                        !! Form::hidden('active_theme_path',$actualTheme['path']) !!}
                        !! Form::hidden('active_theme_name',$actualTheme['name']) !!}
                        <button type="submit" class="btn btn-primary">Activate</button>
                        !! Form::close() !!}
                        else
                        
                        <button class="btn disabled">Active</button>
                        endif
                    </td-->

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection

