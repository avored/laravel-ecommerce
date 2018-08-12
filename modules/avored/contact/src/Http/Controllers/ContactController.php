<?php

namespace AvoRed\Contact\Http\Controllers;

use AvoRed\Contact\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use AvoRed\Contact\Mails\ContactMail;
use AvoRed\Contact\Mails\ContactMailRequest;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class ContactController extends Controller
{

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $repository;

    public function __construct(ConfigurationInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index() {
        return view('avored-contact::contact.index');
    }

    public function send(ContactRequest $request) {

        $adminEmail = $this->repository->getValueByKey('general_administrator_email');

        // Sent an Email to AvoRed Administrator
        Mail::to($adminEmail)->send(new ContactMailRequest($request));

        // Sent an Email to AvoRed Requested User
        Mail::to($request->get('email'))->send(new ContactMail());


        return redirect()->route('contact.index')->with('successNotification', 'Your Request has been sent!');
    }
}
