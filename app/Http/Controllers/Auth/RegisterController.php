<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Ecommerce\Models\Database\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use AvoRed\Ecommerce\Events\UserRegisteredEvent;
use AvoRed\Ecommerce\Mail\NewUserMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $userActivationRequired = Configuration::getConfiguration('user_activation_required');

        if (1 == $userActivationRequired) {
            $request->merge(['activation_token' => Str::random(60)]);
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user = User::create($request->all());
        Event::fire(new UserRegisteredEvent($user));

        Mail::to($user)->send(new NewUserMail($user));

        if (0 == $userActivationRequired) {
            $this->guard()->login($user);
            return redirect($this->redirectPath());
        } else {
            return redirect()->route('login')
                            ->with('notificationText', 'Please Active your account then you can login!');
        }
    }

    public function activateAccount($token, $email)
    {
        $user = User::whereEmail($email)->first();

        if ($token == $user->activation_token) {
            $user->update(['activation_token' => null]);
            Auth::loginUsingId($user->id);
            return redirect()->route('my-account.home');
        }

        return redirect()->route('login')->withErrors(['email' => 'User Activation token is invalid.']);
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
