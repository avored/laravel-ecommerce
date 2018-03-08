<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Ecommerce\Http\Requests\RoleRequst;
use AvoRed\Ecommerce\DataGrid\Facade as DataGrid;
use AvoRed\Ecommerce\Models\Database\Permission;

class RoleController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Role::query())
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.role.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-role-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.role.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-role-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('avored-ecommerce::admin.role.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin.role.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\RoleRequst $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequst $request)
    {

        try {
            $role = Role::create($request->all());
            $this->_saveRolePermissions($request, $role);

        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return redirect()->route('admin.role.index')->with('notificationText', " New Role has been Created Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findorfail($id);

        return view('avored-ecommerce::admin.role.edit')
            ->with('model', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\RoleRequst $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequst $request, $id)
    {
        try {
            $role = Role::findorfail($id);
            $role->update($request->all());
            $this->_saveRolePermissions($request, $role);
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return redirect()->route('admin.role.index')->with('notificationText', " Role Updates Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);

        return redirect()->route('admin.role.index')->with('notificationText', " Role Destroy Successfully!");
    }

    private function _saveRolePermissions($request, $role)
    {
        $permissionIds = [];

        if (count($request->get('permissions')) > 0) {
            //$permissionIds = Collection::make([]);
            foreach ($request->get('permissions') as $key => $value) {
                //save it into db
                if ($value != 1) {
                    continue;
                }
                $permissions = explode(',', $key);
                foreach ($permissions as $permissionName) {
                    if (null === ($permissionModel = Permission::getPermissionByName($permissionName))) {
                        $permissionModel = Permission::create(['name' => $permissionName]);
                    }
                    $permissionIds[] = $permissionModel->id;
                }
            }
        }
        $ids = array_unique($permissionIds);
        $role->permissions()->sync($ids);
        return $this;
    }
}
