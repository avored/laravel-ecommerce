<?php

namespace Mage2\User\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\User\Requests\UserProfileRequest;

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
}
