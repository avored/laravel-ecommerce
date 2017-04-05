<?php

namespace Mage2\User\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\User\Models\AdminUser;
use Mage2\User\Models\Role;
use Mage2\User\Requests\Admin\AdminUserRequest;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;


class AdminUserController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new AdminUser());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mage2user::admin.user.admin-user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->_getRoleOptions();
        return view('mage2user::admin.user.admin-user.create')
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\AdminUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->get('password'))]);


        //TMP only once we add user role then remove it???

        $role = Role::all()->first();
        $request->merge(['role_id' => $role->id]);

        AdminUser::create($request->all());

        return redirect()->route('admin.admin-user.index');
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
        $user = AdminUser::findorfail($id);
        $roles = $this->_getRoleOptions();
        return view('mage2user::admin.user.admin-user.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $user = AdminUser::findorfail($id);
        $user->update($request->all());

        return redirect()->route('admin.admin-user.index');
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
        AdminUser::destroy($id);

        return redirect()->route('admin.admin-user.index');
    }

    private function _getRoleOptions()
    {

        return [0 => 'Please Select'] + Role::all()->pluck('name', 'id')->toArray();
    }
}
