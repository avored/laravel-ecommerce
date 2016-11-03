<?php

namespace Mage2\User\Controllers\Admin;

use Mage2\System\Controllers\Controller;
use Mage2\User\Models\User;
use Mage2\User\Models\Role;
use Mage2\User\Requests\Admin\UserRequest;
use Mage2\Framework\DataGrid\DataGridFacade as DataGrid;
use Illuminate\Support\Collection;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $dataGrid = DataGrid::make($user);

        $dataGrid->addColumn(DataGrid::textColumn('first_name', 'First Name'));
        $dataGrid->addColumn(DataGrid::textColumn('last_name', 'Last Name'));
        $dataGrid->addColumn(DataGrid::textColumn('email', 'Email'));
        $dataGrid->addColumn(DataGrid::linkColumn('edit', 'Edit', function ($label, $row) {
            return "<a href='" . route('admin.user.edit', $row->id) . "'>Edit</a>";
        }));

        $dataGrid->addColumn(DataGrid::linkColumn('destroy', 'Destroy', function ($label, $row) {
            return "<form method='post' action='" . route('admin.user.destroy', $row->id) . "'>" .
            "<input type='hidden' name='_method' value='delete'/>" .
            csrf_field() .
            '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>' .
            "</form>";
        }));

        return view('admin.user.user.index')
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
        return view('admin.user.user.create')
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\UserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('admin.user.index');
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
        $user = User::findorfail($id);
        $roles = $this->_getRoleOptions();
        return view('admin.user.user.edit')
            ->with('user', $user)
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\UserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findorfail($id);
        $user->update($request->all());

        return redirect()->route('admin.user.index');
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

        return redirect()->route('admin.user.index');
    }

    private function _getRoleOptions() {

        return [0 => 'Please Select'] + Role::all()->pluck('name','id')->toArray();
    }
}
