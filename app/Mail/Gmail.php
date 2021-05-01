<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Gmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $header;

    /**
     * Create a new message instance.
     *
     * @param $details
     * @param $header
     */
    public function __construct($details, $header)
    {
        $this->details = $details;
        $this->header = $header;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->header)
            ->view('email.gmail')
            ->from('daniel.garciavarela@iesmiguelherrero.com');
    }
}
