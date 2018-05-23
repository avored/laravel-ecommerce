<?php

namespace App\Http\Controllers\User;

use AvoRed\Ecommerce\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UploadUserImageRequest;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use AvoRed\Framework\Image\Facade as Image;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        return view('user.my-account.home')
            ->with('user', $user);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user.my-account.edit')
            ->with('user', $user);
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

        $relativePath = 'uploads/users/' . $user->id;
        $path = $relativePath;

        $dbPath = $relativePath . DIRECTORY_SEPARATOR . $image->getClientOriginalName();

        $this->directory(public_path($relativePath));

        Image::upload($image, $path);

        $user->update(['image_path' => $dbPath]);

        return redirect()->route('my-account.home')
            ->with('notificationText', 'User Profile Image Uploaded successfully!!');
    }

    public function changePassword()
    {
        return view('user.my-account.change-password');
    }

    /**
     * Create Directories if not exists
     *
     * @var string $path
     * @return \AvoRed\Framework\Image\Service
     */
    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0775, true, true);
        }
        return $this;
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
