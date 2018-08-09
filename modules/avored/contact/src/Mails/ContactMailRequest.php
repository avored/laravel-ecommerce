<?php

namespace AvoRed\Contact\Mails;

use AvoRed\Contact\Http\Requests\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $name
     */
    public $name;

    /**
     * @var $phone
     */
    public $phone;

    /**
     * @var $email
     */
    public $email;

    /**
     * @var $message
     */
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactRequest $request)
    {
        $this->name     = $request->get('name');
        $this->phone    = $request->get('phone');
        $this->email    = $request->get('email');
        $this->message  = $request->get('message');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->email, $this->name)
                ->markdown("avored-contact::mails.contact-request");

    }
}
