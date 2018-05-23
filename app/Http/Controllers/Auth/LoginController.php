<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Ecommerce\Models\Database\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

    /**
     * Admin User Controller constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest', ['except' => 'logout']);

        $url = URL::previous();
        $checkoutUrl = route('checkout.index');

        if ($url == $checkoutUrl) {
            $this->redirectTo = $checkoutUrl;
        }
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::whereEmail($request->get('email'))->first();

        if (!empty($user->activation_token)) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Please Activate your email', 'enableResendLink' => 'true']);
            ;
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Return url for after user  Login or Register
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('my-account.home');
    }
}
