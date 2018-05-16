<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\AdminUser as Model;
use AvoRed\Ecommerce\DataGrid\AdminUser;
use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Framework\Image\Facade as Image;
use AvoRed\Ecommerce\Http\Requests\AdminUserRequest;

class AdminUserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUserGrid = new AdminUser(Model::query()->orderBy('id', 'desc'));

        return view('avored-ecommerce::admin-user.index')->with('dataGrid', $adminUserGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::options();

        return view('avored-ecommerce::admin-user.create')
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

        Model::create($request->all());

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
        $user = Model::find($id);
        $roles = Role::options();

        return view('avored-ecommerce::admin-user.edit')
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
        $user = Model::find($id);
        $path = $this->_getUserImageRelativePath();
        if(null !== $request->file('image')) {
            $image = Image::upload($request->file('image'), $path);
            $request->merge(['image_path' => $image->relativePath]);
        }
        

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
        Model::destroy($id);

        return redirect()->route('admin.admin-user.index');
    }

    public function apiShow()
    {
        $user = Auth::guard('admin')->user();
        $client = Client::wherePasswordClient(1)->whereUserId($user->id)->first();

        return view('avored-ecommerce::admin-user.show-api')->with('client', $client);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::guard('admin')->user();

        return view('avored-ecommerce::admin-user.show')->with('user', $user);
    }

    private function _getUserImageRelativePath()
    {
        $tmpPath = str_split(strtolower(str_random(3)));

        return '/uploads/users/images/'.implode('/', $tmpPath);
    }
}
