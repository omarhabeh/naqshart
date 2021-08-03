<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class track extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $ordernum;
    public $palette;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$ordernum,$palette)
    {
        $this->order = $order;
        $this->ordernum = $ordernum;
        $this->palette = $palette;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.track')->subject('Your art piece is on the way!');
    }
}
