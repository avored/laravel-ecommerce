<?php
namespace Mage2\User\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Mage2\Framework\System\Controllers\Controller;

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
        $this->middleware('frontguest');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
