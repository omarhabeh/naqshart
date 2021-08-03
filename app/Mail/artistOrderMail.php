<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class artistOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $palette;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($palette)
    {
        $this->palette = $palette;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.artistOrderMail')->subject('!تم طلب إحدى أعمالك الفنية');
    }
}
