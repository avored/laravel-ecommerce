<?php

namespace Mage2\User\Controllers\Admin;

use Mage2\System\Controllers\Controller;
use Mage2\User\Models\AdminUser;
use Mage2\User\Models\Role;
use Mage2\User\Requests\Admin\AdminUserRequest;
use Mage2\Framework\DataGrid\DataGridFacade as DataGrid;
use Illuminate\Support\Collection;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new AdminUser();
        $dataGrid = DataGrid::make($user);

        $dataGrid->addColumn(DataGrid::textColumn('first_name', 'First Name'));
        $dataGrid->addColumn(DataGrid::textColumn('last_name', 'Last Name'));
        $dataGrid->addColumn(DataGrid::textColumn('email', 'Email'));
        $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($row) {
            return "<a href='" . route('admin.admin-user.edit', $row->id) . "'>Edit</a>";
        }));

        $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($row) {
            return "<form method='post' action='" . route('admin.admin-user.destroy', $row->id) . "'>" .
            "<input type='hidden' name='_method' value='delete'/>" .
            csrf_field() .
            '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
            "</form>";
        }));

        return view('admin.user.admin-user.index')
            ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->_getRoleOptions();
        return view('admin.user.admin-user.create')
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
        return view('admin.user.admin-user.edit')
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
        User::destroy($id);

        return redirect()->route('admin.admin-user.index');
    }

    private function _getRoleOptions() {

        return [0 => 'Please Select'] + Role::all()->pluck('name','id')->toArray();
    }
}
