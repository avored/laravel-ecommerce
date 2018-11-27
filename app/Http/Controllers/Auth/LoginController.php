<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Framework\Models\Database\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;

class LoginController extends Controller
{
    const CONFIG_KEY = 'user_logout_keep_cart_products';

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
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $rep = app(ConfigurationInterface::class);
        $keepCartItems = $rep->getValueByKey(self::CONFIG_KEY);
        if ($keepCartItems) {
            $config = $cartItems = $request->session()->get('cart_products');
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        if ($keepCartItems) {
            Session::put('cart_products', $cartItems);
        }

        return $this->loggedOut($request) ?: redirect('/');
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

    /**
     * Do a Provider based login
     * @param string $provider
     *
     */
    public function providerLogin($provider)
    {
        $rep = app(ConfigurationInterface::class);

        $clientId = $rep->getValueByKey('users_' . $provider . '_client_id');
        $clientSecret = $rep->getValueByKey('users_' . $provider . '_client_secret');

        //dd($clientId, $clientSecret);
        Config::set('services.' . $provider, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect' => asset('login/' . $provider . '/callback')
        ]);

        //dd(Config::get('services.github'));
        //dd($provider);

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Do a Provider based login
     * @param string $provider
     *
     */
    public function providerCallback($provider)
    {
        $rep = app(ConfigurationInterface::class);

        $clientId = $rep->getValueByKey('users_'. $provider .'_client_id');
        $clientSecret = $rep->getValueByKey('users_'. $provider .'_client_secret');

        Config::set('services.' . $provider, [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect' => asset('login/'. $provider .'/callback')
        ]);

        $user = Socialite::driver($provider)->stateless()->user();

        dd($user);
    }
}
