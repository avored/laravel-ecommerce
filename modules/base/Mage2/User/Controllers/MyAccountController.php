<?php

namespace Mage2\User\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mage2\User\Requests\ChangePasswordRequest;
use Mage2\User\Requests\UploadUserImageRequest;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\User\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller {

    public function home() {
        $user = Auth::user();

        return view('user.my-account.home')
                        ->with('user', $user);
    }

    public function edit() {
        $user = Auth::user();

        return view('user.my-account.edit')
                        ->with('user', $user);
    }

    public function store(UserProfileRequest $request) {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('my-account.home');
    }

    public function uploadImage() {
        return view('user.my-account.upload-image');
    }

    public function uploadImagePost(UploadUserImageRequest $request) {

        $user = Auth::user();
        $image = $request->file('profile_image');
        $destinationPath = 'uploads/users/';
        $relativePath = implode('/', str_split(strtolower(str_random(3)))) . '/';
        $image->move($destinationPath . $relativePath, $image->getClientOriginalName());

        $user->update(['image_path' => $relativePath . $image->getClientOriginalName()]);


        return redirect()->route('my-account.home')
                        ->with('notificationText', 'User Profile Image Uploaded successfully!!');
    }

    public function changePassword() {
        return view('user.my-account.change-password');
    }

    public function changePasswordPost(ChangePasswordRequest $request) {

        $user = Auth::user();
        if (Hash::check($request->get('current_password') , $user->password ) ) {
            $user->update(['password' => bcrypt($request->get('password'))]);
            return redirect()->route('my-account.home')
                            ->with('notificationText', 'User Password Changed Successfully!');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Your Current Password Wrong!']);
        }
    }

}
