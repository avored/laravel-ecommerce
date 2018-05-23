<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset emails and
      | includes a trait which assists in sending these notifications from
      | your application to your users. Feel free to explore this trait.
      |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
