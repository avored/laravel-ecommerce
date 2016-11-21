<?php

namespace Mage2\Order\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mage2\User\Models\User;

class UpdateOrderStatusMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $orderStatusTitle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderStatus) {
        $this->orderStatusTitle = $orderStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('mail.update-order-status');
    }

}
