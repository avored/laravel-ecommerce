<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UploadUserImageRequest;
use App\Http\Requests\UserProfileRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use AvoRed\Framework\Image\Facades\Image;

use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Models\Database\User;

use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;

use App\Http\Requests\MyAccount\Order\OrderReturnRequest;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
    */
    protected $configurationRepository;


    public function __construct(ConfigurationInterface $configurationRepository)
    {
        parent::__construct();
        $this->configurationRepository = $configurationRepository;
    }

    public function home()
    {
        $user = Auth::guard()->user();
        $orders = Order::whereUserId($user->id)->get();
        
        return view('user.my-account.home', ['user' => $user, 'orders' => $orders]);
    }

    public function edit()
    {
        $user = Auth::user();
        $deleteRequestText = $this->configurationRepository->getValueByKey('user_delete_request_text');

        return view('user.my-account.edit')
            ->withUser($user)
            ->withDeleteRequestText($deleteRequestText);
    }

    /**
     *
     * Update User Profile Fields and Return to My Account Page
     *
     * @param \App\Http\Requests\UserProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     */
    public function store(UserProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('my-account.home');
    }

    public function uploadImage()
    {
        return view('user.my-account.upload-image');
    }

    /**
     * @param \App\Http\Requests\UploadUserImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImagePost(UploadUserImageRequest $request)
    {
        $user = Auth::user();
        $image = $request->file('profile_image');
        if (false === empty($user->image_path)) {
            $user->image_path->destroy();
        }

        $image = Image::upload($request->file('profile_image'), 'users/' . $user->id)->makeSizes()->get();
        $user->update(['image_path' => $image->relativePath]);

        return redirect()->route('my-account.home')
            ->with('notificationText', 'User Profile Image Uploaded successfully!!');
    }

    public function changePassword()
    {
        return view('user.my-account.change-password');
    }

    public function changePasswordPost(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->update(['password' => bcrypt($request->get('password'))]);
            return redirect()->route('my-account.home')
                ->with('notificationText', 'User Password Changed Successfully!');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Your Current Password Wrong!']);
        }
    }
}
