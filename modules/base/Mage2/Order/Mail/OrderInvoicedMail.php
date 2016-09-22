<?php
namespace Mage2\Order\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mage2\Order\Models\Order;

class OrderInvoicedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;
    protected $path;

    public function __construct(Order $order, $path)
    {
        $this->path = $path;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order-invoiced')->attach($this->path,['as' => 'invoiced.pdf', 'mime' => 'application/pdf']);
            //->with('order', $this->order);
    }
}
