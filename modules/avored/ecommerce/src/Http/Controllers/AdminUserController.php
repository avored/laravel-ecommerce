<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\AdminUser as Model;
use AvoRed\Ecommerce\DataGrid\AdminUser as AdminUserGrid;
use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Framework\Image\Facade as Image;
use AvoRed\Ecommerce\Http\Requests\AdminUserRequest;
use AvoRed\Ecommerce\Models\Contracts\AdminUserInterface;


class AdminUserController extends Controller
{
    /**
     * 
     * @var \AvoRed\Ecommerce\Models\Repository\AdminUserRepository
     */
    protected $repository;

    public function __construct(AdminUserInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUserGrid = new AdminUserGrid($this->repository->query());

        return view('avored-ecommerce::admin-user.index')->with('dataGrid', $adminUserGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin-user.create');
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

        $this->repository->create($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Ecommerce\Models\Database\AdminUser $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $adminUser)
    {
        return view('avored-ecommerce::admin-user.edit')
                    ->with('model', $adminUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, Model $adminUser)
    {  
        if(null !== $request->file('image')) {
            $path   = $this->_getUserImageRelativePath();
            $image  = Image::upload($request->file('image'), $path);
            $request->merge(['image_path' => $image->relativePath]);
        }

        $adminUser->update($request->all());

        return redirect()->route('admin.admin-user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $adminUser)
    {
        $adminUser->delete();
        return redirect()->route('admin.admin-user.index');
    }

    public function apiShow()
    {
        $user   = Auth::guard('admin')->user();
        $client = Client::wherePasswordClient(1)->whereUserId($user->id)->first();

        return view('avored-ecommerce::admin-user.show-api')->with('client', $client);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
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
