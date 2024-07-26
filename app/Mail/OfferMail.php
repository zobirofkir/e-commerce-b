<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $offer;

    /**
     * Create a new message instance.
     *
     * @param array $offer
     */
    public function __construct(array $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selected offer')
                    ->view('emails.offer')
                    ->with('offer', $this->offer);
    }
}
