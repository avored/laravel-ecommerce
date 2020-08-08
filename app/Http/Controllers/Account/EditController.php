<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    /**
     * Show the user account dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $user = Auth::guard('customer')->user();
        return view('account.edit')
            ->with('user', $user);
    }
}
