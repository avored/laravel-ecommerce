<?php

namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\DataGrid\Role;
use AvoRed\Ecommerce\Repository\User;
use AvoRed\Ecommerce\Http\Requests\RoleRequst;
use AvoRed\Ecommerce\Models\Database\Permission;
use AvoRed\Framework\DataGrid\Facade as DataGrid;

class RoleController extends AdminController
{
    /**
     * AvoRed Product Repository.
     *
     * @var \AvoRed\Ecommerce\Repository\User
     */
    protected $userRepository;

    /**
     * Admin User Controller constructor to Set AvoRed Ecommerce User Repository.
     *
     * @param \AvoRed\Ecommerce\Repository\User $repository
     * @return void
     */
    public function __construct(User $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleGrid = new Role($this->userRepository->roleModel()->query());

        return view('avored-ecommerce::admin.role.index')->with('dataGrid', $roleGrid->dataGrid);
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
            $role = $this->userRepository->roleModel()->create($request->all());
            $this->_saveRolePermissions($request, $role);
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.role.index')->with('notificationText', ' New Role has been Created Successfully!');
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
        $role = $this->userRepository->roleModel()->findorfail($id);

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
            $role = $this->userRepository->roleModel()->findorfail($id);
            $role->update($request->all());
            $this->_saveRolePermissions($request, $role);
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.role.index')->with('notificationText', ' Role Updates Successfully!');
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
        $this->userRepository->roleModel()->destroy($id);

        return redirect()->route('admin.role.index')->with('notificationText', ' Role Destroy Successfully!');
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
