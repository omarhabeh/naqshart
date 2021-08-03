<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $order;
    public $palettes;
    public $pallete_price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$order,$palettes,$pallete_price)
    {
        $this->data = $data;
        $this->order = $order;
        $this->palettes = $palettes;
        $this->pallete_price = $pallete_price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order')->subject('Thank you for your order!');
    }
}
