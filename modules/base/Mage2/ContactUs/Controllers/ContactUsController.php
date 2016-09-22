<?php

namespace Mage2\ContactUs\Controllers;

use Mage2\ContactUs\Requests\ContactUsRequest;
use Mage2\Framework\Http\Controllers\Controller;

class ContactUsController extends Controller
{

    public function getContactUs() {
        return view('contact-us');
    }

    public function postContactUs(ContactUsRequest $request)
    {
        return $request->all();

    }

}
