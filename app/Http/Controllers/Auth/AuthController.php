<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use CrazyCommerce\Admin\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/login';
    protected $loginView;
    protected $guard = "web";
    protected $registerView;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct();
               
        $this->middleware('frontguest', ['except' => 'logout']);
        if($request->get('page') == 'checkout') {
             $this->redirectTo = '/checkout';
        } else {
            $this->redirectTo = '/my-account';
            
        }
        $this->loginView    = $this->theme. ".auth.login";
        $this->registerView = $this->theme. ".auth.register";
        //dd($this->loginView);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
