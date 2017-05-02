@extends('mage2install::layouts.install')
@section('content')

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome to Mage2 Installation</div>
                <div class="panel-body">

                    <h2 class="text-center">Database Table Setup</h2>

                    {!! Form::open(['id' => 'install-module-form','method' => 'post','action' => route('mage2.install.database.table.post')]) !!}

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

                                @if($sessionData[$module->getIdentifier()] == "uninstall")
                                    <button type="button" class="btn disabled btn-primary">UnInstall</button>
                                @else
                                    <button type="button" class="btn disabled btn-primary">Install</button>
                                @endif

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
                        <input type="hidden" name="identifier" value="{{ $identifier }}">
                        <button type="button" class="btn btn-primary install-new-button">Install Next</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
@push('scripts')
<script>

    jQuery(document).ready(function() {

        jQuery('.install-new-button').click(function (e) {

            //#install-module-form
            jQuery(this).button('loading');
            jQuery('#install-module-form').submit();
        }) ;

    });
</script>
@endpush


@endsection