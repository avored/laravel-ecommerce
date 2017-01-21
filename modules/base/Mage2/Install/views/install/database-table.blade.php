@extends('mage2install::layouts.install')
@section('content')

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Mage2 Installation</div>
                <div class="panel-body">

                    <h2 class="text-center">Database Table Setup</h2>

                    {!! Form::open(['method' => 'post','action' => route('mage2.install.database.table.post')]) !!}

                    <p>Click Continue to install Database</p>

                    <table class="table bordered tablegrid">
                        <thead>

                        <th>Name</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($modules as $module)

                            <?php //$actualTheme = Theme::getByPath($theme) ?>
                            <tr>

                                <td>{{ $module->getName() }}</td>

                                <td>
                                {!! Form::open(['method' => 'POST', 'action' =>
                                            route('admin.module.install',$module->getIdentifier())]) !!}
                                <button type="submit" class="btn disabled btn-primary">Install</button>
                                {!! Form::close() !!}
                                </td>
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

                    <div class="col s12">
                        <button type="submit" class="btn btn-primary">Install All</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

@endsection