<?php

namespace Mage2\User\Controllers\Admin;

use Mage2\System\Controllers\Controller;
use Mage2\User\Models\Role;
use Mage2\User\Requests\Admin\RoleRequst;
use Mage2\Framework\DataGrid\DataGridFacade as DataGrid;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new Role();
        $dataGrid = DataGrid::make($user);

        $dataGrid->addColumn(DataGrid::textColumn('name','Role Name'));
        $dataGrid->addColumn(DataGrid::textColumn('description','Role Description'));

        $dataGrid->addColumn(DataGrid::linkColumn('edit','Edit',function($label , $row) {
            return "<a href='". route('admin.role.edit', $row->id)."'>Edit</a>";
        }));

        $dataGrid->addColumn(DataGrid::linkColumn('destroy','Destroy',function($label , $row) {
            return "<form method='post' action='".route('admin.role.destroy', $row->id)."'>" .
                    "<input type='hidden' name='_method' value='delete'/>".
                    csrf_field() .
                    '<a href="#" onclick="jQuery(this).parents(\'form:first\').submit()">Destroy</a>'.
                    "</form>";
        }));

        return view('admin.user.role.index')
                ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.role.create');

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
        Role::create($request->all());
        return redirect()->route('admin.role.index')->with('notificationText'," New Role has been Created Successfully!");
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

        return view('admin.user.role.edit')
                    ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\User\Requests\Admin\RoleRequst $request
     * @param int                            $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequst $request, $id)
    {
        $role = Role::findorfail($id);
        $role->update($request->all());

        return redirect()->route('admin.role.index')->with('notificationText'," Role Updates Successfully!");
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

        return redirect()->route('admin.role.index')->with('notificationText'," Role Destroy Successfully!");
    }
}
