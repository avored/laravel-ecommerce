<?php
namespace Mage2\Ecommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mage2\User\Models\User;

class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var \Mage2\Ecommerce\Models\Database\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-user')
            ->with('user', $this->user);
    }
}
