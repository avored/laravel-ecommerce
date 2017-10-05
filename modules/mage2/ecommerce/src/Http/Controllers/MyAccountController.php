<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Ecommerce\Http\Requests\ChangePasswordRequest;
use Mage2\Ecommerce\Http\Requests\UploadUserImageRequest;
use Mage2\Ecommerce\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Hash;
use Mage2\Ecommerce\Image\Facade as Image;

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

        Image::upload($image, $path);

        $user->update(['image_path' => $dbPath]);

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
