<?php

namespace App\Http\Controllers\Auth;

use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Models\Database\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Mail\NewUserMail;
use Illuminate\Support\Facades\Auth;
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
        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user = User::create($request->all());
        event(new Registered($user));
        Mail::to($user)->send(new NewUserMail($user));

        if (0 == $userActivationRequired) {
            $user->markEmailAsVerified();
            $this->guard()->login($user);
            return redirect($this->redirectPath());
        } else {
            return redirect()->route('login')
                            ->with('notificationText', 'Please Active your account then you can login!');
        }
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
