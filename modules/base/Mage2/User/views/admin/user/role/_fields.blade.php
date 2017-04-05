{!! Form::text('name','Role Name') !!}
{!! Form::textarea('description','Role Description') !!}
<div class="row">
    @foreach(Permission::all() as $permission)
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $permission['title'] }}</div>
                <div class="panel-body">


                    @if(isset($role) && $role->hasPermission($permission['routes']));

                        <p><input type="checkbox" checked
                                  class="bootstrap-switch" name="permissions[{{ $permission['routes'] }}]" value='1' /></p>

                    @else
                        <p><input type="checkbox"
                                  class="bootstrap-switch" name="permissions[{{ $permission['routes'] }}]" value='1' /></p>
                    @endif


                </div>
            </div>
        </div>
    @endforeach
</div>
