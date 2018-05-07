<?php

namespace AvoRed\Ecommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateOrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $orderStatusTitle;

    /**
     * Create a new message instance.
     *
     * @param $orderStatus
     */
    public function __construct($orderStatus)
    {
        $this->orderStatusTitle = $orderStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('avored-ecommerce::mail.update-order-status');
    }
}
