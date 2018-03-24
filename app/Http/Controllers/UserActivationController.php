<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Ecommerce\Repository\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use AvoRed\Ecommerce\Mail\NewUserMail;

class UserActivationController extends Controller
{

    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param \AvoRed\Ecommerce\Repository\User
     * @return void
     */
    public function __construct(User $repository)
    {
        parent::__construct();
        $this->middleware('front.guest');

        $this->userRepository = $repository;
    }

    public function activateAccount($token, $email)
    {

        $user = $this->userRepository->findUserByEmail($email);


        if($token == $user->activation_token) {

            $user->update(['activation_token' => null]);
            Auth::loginUsingId($user->id);
            return redirect()->route('my-account.home');
        }

        return redirect()->route('login')->withErrors(['email' => 'User Activation token is invalid.']);

    }

    public function resend() {
        return view('auth.user.resend');
    }

    public function resendPost(Request $request) {

        $user = $this->userRepository->findUserByEmail($request->get('email'));
        Mail::to($user)->send(new NewUserMail($user));


        return redirect()->back()->with('notificationText', 'User Activation Email Sent! Please Check your email');

    }

}
