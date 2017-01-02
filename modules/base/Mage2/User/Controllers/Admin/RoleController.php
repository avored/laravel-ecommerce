<?php

namespace Mage2\User\Controllers\Admin;

use Mage2\Framework\System\Controllers\AdminController;
use Mage2\User\Models\Role;
use Mage2\User\Requests\Admin\RoleRequst;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Mage2\User\Models\Permission;
use Mage2\User\Models\AdminUser;
use Illuminate\Support\Facades\Gate;

class RoleController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = new Role();
        $dataGrid = DataGrid::make($role);

        $dataGrid->addColumn(DataGrid::textColumn('name', 'Role Name'));
        $dataGrid->addColumn(DataGrid::textColumn('description', 'Role Description'));

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.role.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
                return "<a href='" . route('admin.role.edit', $row->id) . "'>Edit</a>";
            }));
        }

        if (Gate::allows('hasPermission', [AdminUser::class, "admin.role.edit"])) {
            $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
                return "<form method='post' action='" . route('admin.role.destroy', $row->id) . "'>" .
                "<input type='hidden' name='_method' value='delete'/>" .
                csrf_field() .
                '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
                "</form>";
            }));
        }

        return view('mage2user::admin.user.role.index')
            ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2user::admin.user.role.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\RoleRequst $request
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
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('mage2user::admin.user.role.edit')
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\RoleRequst $request
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
