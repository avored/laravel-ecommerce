<?php

namespace Mage2\User\Controllers;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Mage2\Framework\System\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('frontguest');
    }
    protected function guard()
    {
        return Auth::guard('web');
    }
}
