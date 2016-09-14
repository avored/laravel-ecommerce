<?php
namespace Mage2\User\Controllers;


use Mage2\User\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Mage2\Framework\Http\Controllers\Controller;

class MyAccountController extends Controller
{
    public function home() {

        $user = Auth::user();
        return view("my-account.home")
                ->with('user', $user)
                ;
    }

    public function edit() {

        $user = Auth::user();
        return view("my-account.edit")
            ->with('user', $user)
            ;
    }

    public function store(UserProfileRequest $request) {

        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('my-account.home');
    }

  
}
