<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use AvoRed\Ecommerce\Http\Requests\AdminUserRequest;
use AvoRed\Framework\Image\Facade as Image;
use AvoRed\Ecommerce\Repository\User;
use AvoRed\Ecommerce\DataGrid\AdminUser;

class AdminUserController extends AdminController
{
    /**
     * AvoRed Product Repository
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
        $adminUserGrid = new AdminUser($this->userRepository->adminUserModel()->query()->orderBy('id','desc'));

        return view('avored-ecommerce::admin.admin-user.index')->with('dataGrid', $adminUserGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->userRepository->roleOptions();
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

        $this->userRepository->createUser($request->all());

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
        $user = $this->userRepository->findUserById($id);
        $roles = $this->userRepository->roleOptions();

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
        $user   = $this->userRepository->findUserById($id);
        $path   = $this->_getUserImageRelativePath();
        $image  = Image::upload($request->file('image'), $path);

        $request->merge(['image_path' => $image->relativePath]);

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
        $this->userRepository->destroyUserById($id);

        return redirect()->route('admin.admin-user.index');
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


    private function _getUserImageRelativePath() {
        $tmpPath = str_split(strtolower(str_random(3)));
        return '/uploads/users/images/' . implode('/', $tmpPath);
    }
}
