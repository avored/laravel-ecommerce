<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Account\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __invoke(PasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password)
       ]);
       return redirect()->route('account.dashboard');
    }
}
