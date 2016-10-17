<?php

namespace Mage2\ContactUs\Controllers;

use Mage2\ContactUs\Mail\ContactUsMail;
use Mage2\ContactUs\Requests\ContactUsRequest;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{

    public function getContactUs() {
        return view('contact-us.contact-us');
    }

    public function postContactUs(ContactUsRequest $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
        }

        $request->merge([
            'full_name' => $user->full_name,
            'email' => $user->email
        ]);
        Mail::to($user->email)->send(new ContactUsMail($request->all()));


        return redirect()->back();

    }

}
