<?php

namespace AvoRed\Contact\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('avored-contact::mails.contact-acknoledgement');
    }
}
