<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests;
use Mage2\Admin\Models\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function home() {

        $user = Auth::user();
        return view($this->theme.".my-account.home")
                ->with('user', $user)
                ;
    }

    public function edit() {

        $user = Auth::user();
        return view($this->theme.".my-account.edit")
            ->with('user', $user)
            ;
    }

    public function store(UserProfileRequest $request) {

        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('my-account.home');
    }

  
}
