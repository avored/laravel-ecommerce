<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use AvoRed\Ecommerce\Models\Database\AdminUser;
use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Ecommerce\Http\Requests\AdminUserRequest;
use AvoRed\Ecommerce\DataGrid\Facade as DataGrid;
use AvoRed\Ecommerce\Image\Facade as Image;

class AdminUserController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(AdminUser::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('first_name',['label' => 'First Name'])
            ->column('last_name',['label' => 'Last Name'])
            ->linkColumn('show_api',['label' => 'Show API'], function($model) {
                return "<a href='". route('admin.admin-user.show.api')."' >Show API</a>";
            })
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.admin-user.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-admin-user-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.admin-user.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-admin-user-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('avored-ecommerce::admin.admin-user.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->_getRoleOptions();
        return view('avored-ecommerce::admin.admin-user.create')
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\AdminUserRequest $request
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
        return view('avored-ecommerce::admin.admin-user.edit')
            ->with('model', $user)
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $image = $request->file('image');
        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/users/images/' . implode('/', $tmpPath);

        $image = Image::upload($image, $checkDirectory);


        $request->merge(['image_path' => $image->relativePath]);


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

    public function apiShow() {

        $user = Auth::guard('admin')->user();
        $client = Client::wherePasswordClient(1)->whereUserId($user->id)->first();

        return view('avored-ecommerce::admin.admin-user.show-api')->with('client', $client);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::guard('admin')->user();

        return view('avored-ecommerce::admin.admin-user.show')->with('user', $user);

    }
}


